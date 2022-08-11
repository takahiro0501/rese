<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //初期投入データ
        $this->call(AreasTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(ShopsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ShopTimesTableSeeder::class);

    //サンプルデータ
        $this->call(favoriteTableSeeder::class);
        $this->call(reservationsTableSeeder::class);
        $this->call(ratingsTableSeeder::class);

    }
}
