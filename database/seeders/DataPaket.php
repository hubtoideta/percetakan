<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPaket extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::delete('delete from data_pakets');

        $array_data = array('Premium' => '149000', 'Business' => '299000');
        foreach($array_data as $name => $value){
            DB::table('data_pakets')->insert([
                'nama_paket' => $name,
                'harga_paket' => $value,
            ]);
        }
    }
}
