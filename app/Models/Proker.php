<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proker extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function Divisi(): BelongsTo {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
    
    public function User(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}
