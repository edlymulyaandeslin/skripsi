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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
                ->orWhere(function ($query) use ($search) {
                    $query->whereHas('mahasiswa', function ($query) use ($search) {
                        $query->where('nim_or_nidn', 'like', '%' . $search . '%')
                            ->orWhere('name', 'like', '%' . $search . '%')
                            ->orWhere('tahun_ajaran', 'like', '%' . $search . '%');
                    });
                });
        });
    }

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
