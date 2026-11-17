<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Acara extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function absensis(): HasMany
    {
        return $this->hasMany(Absensi::class);
    }

    public function getBisaAbsenAttribute(): bool
    {
        $tgl = Carbon::parse($this->tgl_kegiatan)->startOfDay();

        return now()->startOfDay()->between($tgl, $tgl->copy()->addDays(7));
    }
}
