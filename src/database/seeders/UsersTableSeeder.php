<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->command->info("ユーザデータの作成を開始します...");

        $json = file_get_contents(__DIR__ . '/data/users.json');
        $users = json_decode($json, true);

        $count = 0;
        foreach ($users['users'] as $user) {
            if($user['email_verified_at'] == ''){
                User::create([
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'password' => Hash::make($user['password']),
                        'role_id' => $user['role_id']
                    ]);
            } else {
                User::create([
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'email_verified_at' => $user['email_verified_at'],
                        'password' => Hash::make($user['password']),
                        'role_id' => $user['role_id']
                    ]);
            }

            $count++;
        }

        $this->command->info("ユーザデータを{$count}件、作成しました。");

    }
}

