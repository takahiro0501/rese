<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FavoriteShop;


class favoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("店舗お気に入り情報データの作成を開始します...");

        $json = file_get_contents(__DIR__ . '/data/favorite.json');
        $favorites = json_decode($json, true);

        $count = 0;
        foreach ($favorites['favorite'] as $favorite) {
            FavoriteShop::create($favorite);
            $count++;
        }

        $this->command->info("店舗お気に入り情報データを{$count}件、作成しました。");
    }
}
