<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absensi extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function acara(): BelongsTo
    {
        return $this->belongsTo(Acara::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function divisi(): BelongsTo
    {
        return $this->belongsTo(Divisi::class);
    }
}
