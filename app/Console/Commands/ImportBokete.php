<?php

namespace App\Console\Commands;

use App;

use App\Libraries\WebCrawler\BoketeSpider;
use App\Models\Bokete;
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
            $this->info('create bokete list!');
        }
        
        if ($type == 'update') {
            $boketes = $this->getBoketeFilterUpdated();
            $this->updateBoketeList($boketes);
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
            foreach ($list as $bokete) {
                $boketeSpider = new BoketeSpider($this->baseurl.$bokete->url);
                $this->saveBokete($boketeSpider);
            }
        }
    }
    
    public function saveBoketeList($list)
    {
        if (! empty($list)) {
            foreach ($list as $url) {
                $arr     = explode('/', $url);
                $number  = array_pop($arr);
                Bokete::updateOrCreate([
                  'number'  => $number,
                  'url'     => $url,
                ]);
            }
        }
    }
    
    public function saveBokete(BoketeSpider $boketeSpider)
    {
        $number = $boketeSpider->getNumber();
        Bokete::where('number', $number)
              ->update([
                'content'     => $boketeSpider->getContent(),
                'ranting'     => $boketeSpider->getStarts(),
                'released_at' => $boketeSpider->getReleasedTime(),
                'is_updated'  => 1
              ]);
    }
}
