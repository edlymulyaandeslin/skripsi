<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiKompre extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kompre(): BelongsTo
    {
        return $this->belongsTo(Kompre::class, 'kompre_id');
    }
}
