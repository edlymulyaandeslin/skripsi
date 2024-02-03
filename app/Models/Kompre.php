<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function nilaikompre(): HasOne
    {
        return $this->hasOne(NilaiKompre::class, 'kompre_id');
    }
}
