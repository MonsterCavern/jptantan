<?php

namespace App\Console\Commands;

use App;

use App\Utils\Util;
use App\Models\Bokete;
use App\Libraries\WebCrawler\BoketeSpider;
use Illuminate\Console\Command;

class ImportBokete extends Command
{
    private $baseurl = 'https://bokete.jp/';
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawler:bokete {type=insert}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler Update Bokete';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $type = $this->argument('type');
        
        if ($type == 'insert') {
            $keys = ['boke/popular'];
            foreach ($keys as $key) {
                $list = $this->getList($key);
                $this->saveBoketeList($list);
            }
            $this->line("\r\n");
            $this->info('create bokete list!');
        }
        
        if ($type == 'update') {
            $boketes = $this->getBoketeFilterUpdated();
            $this->updateBoketeList($boketes);
            $this->line("\r\n");
            $this->info('update bokete list!');
        }
        
        $this->info('end');
    }
    
    public function getBoketeFilterUpdated()
    {
        $boketes = Bokete::select('url')->where('is_updated', 0)->get();
        
        return $boketes;
    }
    
    public function getList($key)
    {
        $boketeSpider = new BoketeSpider($this->baseurl.$key);
        $list         = $boketeSpider->getListUrl();
        
        return $list;
    }
    
    public function updateBoketeList($list)
    {
        if (! empty($list)) {
            $bar = $this->output->createProgressBar(count($list));
            foreach ($list as $bokete) {
                $boketeSpider = new BoketeSpider($this->baseurl.$bokete->url);
                $this->saveBokete($boketeSpider);
                $bar->advance();
            }
            $bar->finish();
        }
    }
    
    public function saveBoketeList($list)
    {
        if (! empty($list)) {
            $bar = $this->output->createProgressBar(count($list));
            foreach ($list as $url) {
                $arr     = explode('/', $url);
                $number  = array_pop($arr);
                Bokete::updateOrCreate([
                  'number'  => $number,
                  'url'     => $url,
                ]);
                $bar->advance();
            }
            $bar->finish();
        }
    }
    
    public function saveBokete(BoketeSpider $boketeSpider)
    {
        $number  = $boketeSpider->getNumber();
        $content = $boketeSpider->getContent();
        $content = trim($content);
        $content = preg_split('/[\r\n]+/s', $content);
        Bokete::where('number', $number)
              ->update([
                'content'     => Util::JsonEncode($content),
                'source'      => $boketeSpider->getSource(),
                'ranting'     => $boketeSpider->getStarts(),
                'released_at' => $boketeSpider->getReleasedTime(),
                'is_updated'  => 1
              ]);
    }
}
