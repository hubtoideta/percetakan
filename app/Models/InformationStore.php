<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InformationStore extends Model
{
    use HasUuids;

    protected $table = "information_stores";
    protected $primaryKey = "id_store";

    public function User(): BelongsTo{
        return $this->belongsTo(User::class, 'username_owner', 'username');
    }

    protected $fillable = [
        'username_owner',
        'logo',
        'store_name',
        'store_email',
        'contact',
        'deskripsi',
    ];
}
