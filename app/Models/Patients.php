<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patients extends Model
{
    use HasFactory;

    protected $table = 'patients';
    protected $fillable = [
        'date_of_birth',
        'gender',
        'address',
        'user_id',
    ];

    public function user():BelongsTo
     {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointment(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
