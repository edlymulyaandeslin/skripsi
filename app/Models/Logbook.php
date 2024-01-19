<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logbook extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function judul(): BelongsTo
    {
        return $this->belongsTo(Judul::class, 'judul_id');
    }
}
