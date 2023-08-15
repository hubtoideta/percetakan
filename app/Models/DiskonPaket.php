<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiskonPaket extends Model
{
    public function DataPaket(): BelongsTo{
        return $this->belongsTo(DataPaket::class, 'nama_paket_diskon', 'nama_paket');
    }
}
