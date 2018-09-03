<?php

namespace App\Console\Commands;

use App;

use App\Utils\Util;

use App\Models\Translate;
use App\Libraries\Translate\GoogleTranslation;
use App\Repositories\BoketeRepository;
use App\Repositories\TranslateRepository;

use Illuminate\Console\Command;

class GoogleRobot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'robot:google {type=bokete}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Google Traslate Robot';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GoogleTranslation $googleTranslation, TranslateRepository $translateRepo, BoketeRepository $boketeRepo)
    {
        $this->transform     = $googleTranslation;
        $this->translateRepo = $translateRepo;
        $this->boketeRepo    = $boketeRepo;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(BoketeRepository $boketeRepository)
    {
        $type = $this->argument('type');
        if ($type == 'bokete') {
            $this->info('Start Bokete Translate');
            $list = $boketeRepository->getBoketesByGoogleIDisNull()->get();
            $this->transBoketeTW($list);
        }
        
        $this->line("\r\n");
        $this->info('create bokete list!');
    }
    
    public function transBoketeTW($list)
    {
        if (! empty($list)) {
            $bar = $this->output->createProgressBar(count($list));
            foreach ($list as $bokete) {
                $contents    = $bokete->content;
                $content     = [];
                foreach ($contents as $value) {
                    $content[] = [
                        'before'   => $value,
                        'after'    => $this->transform->execute($value, 'zh-TW'),
                        'note'     => '',
                        'relateds' => []
                    ];
                }
                
                $data['content']     = $content;
                $data['target_id']   = $bokete->number;
                $data['target_type'] = 'boketes';

                $bokete->google_translate_id = $this->saveTranslate($data);
                $bokete->save();

                $bar->advance();
            }
            $bar->finish();
        }
    }
    
    public function saveTranslate($data)
    {
        $teanslate = $this->translateRepo->create([
            'target_id'   => $data['target_id'],
            'target_type' => $data['target_type'],
            'content'     => $data['content'],
            'user_id'     => 1,
        ]);

        return $teanslate->id;
    }
}
