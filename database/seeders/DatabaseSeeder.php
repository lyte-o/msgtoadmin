<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
         User::query()->create([
             'full_name'    => 'Admin',
             'email'        => 'support@msgtoadmin.com',
             'phone'        => '08123456789',
             'status'       => 'active',
             'role'         => 'admin',
             'password'     => bcrypt('adminmsg2022')
         ]);

        User::query()->create([
            'full_name'    => 'Lyte Onyema',
            'email'        => 'lyte.onyema@gmail.com',
            'phone'        => '09074756078',
            'password'     => bcrypt('lytemsg26')
        ]);
    }
}
