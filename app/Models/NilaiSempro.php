<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiSempro extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sempro(): BelongsTo
    {
        return $this->belongsTo(Sempro::class, 'sempro_id');
    }
}
