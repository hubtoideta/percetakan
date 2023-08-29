<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDev extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::delete('delete from users');

        DB::table('users')->insert([
            'username' => 'developer',
            'email' => 'ideadigitalasia@gmail.com',
            'category' => 'Developer',
            'password' => Hash::make('@Ideta.id9999')
        ]);
    }
}
