<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sempro extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('judul', function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhereHas('mahasiswa', function ($query) use ($search) {
                        $query->where('nim_or_nidn', 'like', '%' . $search . '%')
                            ->orWhere('name', 'like', '%' . $search . '%')
                            ->orWhere('tahun_ajaran', 'like', '%' . $search . '%');
                    });
            });
        });
    }

    public function judul(): BelongsTo
    {
        return $this->belongsTo(Judul::class, 'judul_id');
    }

    public function penguji1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penguji1_id');
    }

    public function penguji2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penguji2_id');
    }

    public function penguji3(): BelongsTo
    {
        return $this->belongsTo(User::class, 'penguji3_id');
    }

    public function nilaisempro(): HasOne
    {
        return $this->HasOne(NilaiSempro::class, 'sempro_id');
    }
}
