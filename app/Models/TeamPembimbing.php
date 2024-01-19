<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamPembimbing extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function judul(): HasMany
    {
        return $this->hasMany(Judul::class);
    }


    public function pembimbing1(): HasMany
    {
        return $this->hasMany(User::class, 'pembimbing1_id');
    }

    public function pembimbing2(): HasMany
    {
        return $this->hasMany(User::class, 'pembimbing2_id');
    }
}
