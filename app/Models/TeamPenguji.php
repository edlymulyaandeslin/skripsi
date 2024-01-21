<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamPenguji extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sempro(): HasMany
    {
        return $this->hasMany(Sempro::class);
    }

    public function kompre(): HasMany
    {
        return $this->hasMany(Kompre::class);
    }
}
