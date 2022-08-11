<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class reservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("予約情報データの作成を開始します...");

        $json = file_get_contents(__DIR__ . '/data/reservations.json');
        $reservations = json_decode($json, true);

        $count = 0;
        foreach ($reservations['reservations'] as $reservation) {
            Reservation::create($reservation);
            $count++;
        }

        $this->command->info("予約情報データを{$count}件、作成しました。");
    }
}
