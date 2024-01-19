<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Judul extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function teamPembimbing(): BelongsTo
    {
        return $this->belongsTo(TeamPembimbing::class, 'team_pembimbing_id');
    }

    public function logbook(): HasMany
    {
        return $this->hasMany(Logbook::class);
    }

    public function sempro(): HasMany
    {
        return $this->hasMany(Sempro::class);
    }

    public function kompre(): HasMany
    {
        return $this->hasMany(Kompre::class);
    }
}
