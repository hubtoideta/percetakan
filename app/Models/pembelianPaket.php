<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembelianPaket extends Model
{
    use HasUlids;

    protected $table = "pembelian_pakets";
    protected $primaryKey = "code_pembelian";
    public $timestamps = false;

    protected $fillable = [
        'id_store',
        'paket',
        'jangka_waktu',
        'harga_normal',
        'diskon',
        'ppn',
        'total_pembayaran',
        'status_order',
        'status_paket',
        'order_at',
        'confirm_at',
        'start_paket_at',
        'end_paket_at',
    ];
}
