<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;

class ratingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("評価情報データの作成を開始します...");

        $json = file_get_contents(__DIR__ . '/data/ratings.json');
        $ratings = json_decode($json, true);
        
        $count = 0;
        foreach ($ratings['ratings'] as $rating) {
            Rating::create($rating);
            $count++;
        }

        $this->command->info("評価情報データを{$count}件、作成しました。");
    }
}
