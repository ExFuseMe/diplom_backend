<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventFormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'required',
        'event_form_id',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(EventForm::class, 'event_form_id');
    }
}
