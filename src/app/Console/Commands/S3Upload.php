<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Models\Shop;

class S3Upload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 's3:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '店舗画像の初期データ投入';

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
     * @return int
     */
    public function handle()
    {
        //画像ディレクトのパス取得
        $path = storage_path().'/app/public/';
        //店舗画像とshop_idの対応データ取得
        $json = file_get_contents($path.'shop_img.json');
        $imgnames = json_decode($json, true);
        
        $count = 1;
        foreach($imgnames['img'] as $name){

            $this->info("店舗画像：{$count}件目");

            //s3にアップロード
            $imgpath = Storage::disk('s3')->putFile( 'image' , new File($path.$name['img']), 'public'); 
            //shopsTBLのimgパスの書き換え
            $url = Storage::disk('s3')->url($imgpath);
            $flg = Shop::where('id',$name['shop_id'])->update(['img' => $url]);

            $this->info("店舗画像：{$count}件目終了");
            $count++;

        }

        return 0;
    }
}
