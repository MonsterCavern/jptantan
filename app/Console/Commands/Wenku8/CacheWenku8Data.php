<?php

namespace App\Console\Commands\Wenku8;

use App\Models\Wenku8;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CacheWenku8Data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wenku8:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update wenku8/index.json 檔案';

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
        //
        $wenku8s = Wenku8::all();
        $data    = $wenku8s->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item->only($item->fillable)];
        });
        $wenku8Index     = Storage::disk('wenku8')->get('index.json');
        $wenku8IndexData = json_decode($wenku8Index, true);

        $wenku8IndexData['data']   = $data;
        $wenku8IndexData['length'] = $wenku8s->count();

        $json = json_encode(
            $wenku8IndexData,
            JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
        );

        Storage::disk('wenku8')->put('index.json', $json);
    }
}
