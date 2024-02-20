<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Judul extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];


    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function pembimbing1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembimbing1_id');
    }

    public function pembimbing2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembimbing2_id');
    }

    public function logbook(): HasMany
    {
        return $this->hasMany(Logbook::class, 'judul_id');
    }

    public function sempro(): HasMany
    {
        return $this->hasMany(Sempro::class, 'judul_id');
    }

    public function kompre(): HasMany
    {
        return $this->hasMany(Kompre::class, 'judul_id');
    }
}
