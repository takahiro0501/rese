<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShopTime;

class ShopTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("店舗営業時間データの作成を開始します...");

        $json = file_get_contents(__DIR__ . '/data/shoptimes.json');
        $shoptimes = json_decode($json, true);

        $count = 0;
        foreach ($shoptimes['shoptimes'] as $shoptime) {
            ShopTime::create($shoptime);
            $count++;
        }

        $this->command->info("店舗営業時間データを{$count}件、作成しました。");
    }
}
