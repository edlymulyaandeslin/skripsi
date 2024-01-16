<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sempro extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function judul(): BelongsTo
    {
        return $this->belongsTo(User::class, 'judul_id');
    }

    public function penguji1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penguji1_id');
    }

    public function penguji2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penguji2_id');
    }
}
