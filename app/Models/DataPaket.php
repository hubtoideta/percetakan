<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DataPaket extends Model
{

    protected $fillable = [
        'harga_paket',
    ];

    public function DiskonPaket(): HasOne{
        return $this->hasOne(DiskonPaket::class, 'nama_paket_diskon', 'nama_paket');
    }
}
