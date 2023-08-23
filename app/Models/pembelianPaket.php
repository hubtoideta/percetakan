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
}
