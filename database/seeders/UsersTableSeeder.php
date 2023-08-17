<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verified'           => 1,
                'verified_at'        => '2023-02-10 16:06:59',
                'firstname'          => '',
                'mobile'             => '',
                'verification_token' => '',
            ],
        ];
        foreach ($users as $item) {
            User::updateOrCreate(['id' => $item['id']], $item);
        }

    }
}
