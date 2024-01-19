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


    public function penguji1(): HasMany
    {
        return $this->hasMany(User::class, 'penguji1_id');
    }
    public function penguji2(): HasMany
    {
        return $this->hasMany(User::class, 'penguji2_id');
    }
    public function penguji3(): HasMany
    {
        return $this->hasMany(User::class, 'penguji3_id');
    }
    public function penguji4(): HasMany
    {
        return $this->hasMany(User::class, 'penguji4_id');
    }
    public function penguji5(): HasMany
    {
        return $this->hasMany(User::class, 'penguji5_id');
    }
}
