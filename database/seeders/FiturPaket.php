<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiturPaket extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::delete('delete from fitur_pakets');

        $array_data = array(
            'Karyawan' => ['5','15'],
            'Data Bahan Cetak & Decal' => ['y','y'],
            'Monitoring Proses Produksi' => ['y','y'],
            'Print Nota & Shipping' => ['y','y'],
            'Laporan Omset' => ['y','y'],
            'Perhitungan Biaya Pengiriman' => ['y','y'],
            'Laporan Order' => ['y','y'],
            'Arus Kas' => ['n','y'],
            'Laporan Penggunaan Bahan' => ['n','y'],
            'Toko Online & Upload Produk Retail' => ['n','y'],
            'Dapat Mengakses Toko Template Cetak dan Pola Decal' => ['n','y'],
            'Kerjasama Dengan Percetakan Lain' => ['n','y'],
            'Bermitra dengan Para Penyedia jasa seperti Desainer dan Pemasang' => ['n','y'],
            'Donwload Data (.pdf)' => ['n','y'],
        );

        foreach($array_data as $name => $value){
            DB::table('fitur_pakets')->insert([
                'nama_fitur_paket' => $name,
                'Premium' => $value[0],
                'Business' => $value[1],
            ]);
        }
    }
}
