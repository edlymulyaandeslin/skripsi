<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kompre extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function judul(): BelongsTo
    {
        return $this->belongsTo(Judul::class, 'judul_id');
    }


    public function teampenguji(): BelongsTo
    {
        return $this->belongsTo(TeamPenguji::class, 'team_penguji_id');
    }
}
