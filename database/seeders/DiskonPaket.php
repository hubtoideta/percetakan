<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiskonPaket extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::delete('delete from diskon_pakets');

        $array_data = array(
            'Premium' => [
                '10',
                '15',
                '20',
                '25',
            ],
            'Business' => [
                '10',
                '15',
                '20',
                '25',
            ]
        );

        foreach($array_data as $name => $value){
            DB::table("diskon_pakets")->insert([
                'nama_paket_diskon' => $name,
                'tiga_bulan' => $value[0],
                'enam_bulan' => $value[1],
                'dua_belas_bulan' => $value[2],
                'dua_puluh_empat_bulan' => $value[3],
            ]);
        }
    }
}
