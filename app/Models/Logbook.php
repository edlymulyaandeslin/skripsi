<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logbook extends Model
{
    use HasFactory, HasUuids;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('kategori', 'like', '%' . $search . '%')
                ->orWhereHas('pembimbing', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('judul.mahasiswa', function ($query) use ($search) {
                    $query->where('nim_or_nidn', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                })->orWhere('target_bimbingan', 'like', '%' . $search . '%');
        });
    }

    public function judul(): BelongsTo
    {
        return $this->belongsTo(Judul::class, 'judul_id');
    }

    public function pembimbing(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pembimbing_id');
    }
}
