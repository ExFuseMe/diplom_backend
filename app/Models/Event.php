<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'address',
        'date_time',
    ];

    protected $casts = [
        'date_time' => 'datetime',
    ];

    public function forms(): HasMany
    {
        return $this->hasMany(EventForm::class);
    }
}
