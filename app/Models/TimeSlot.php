<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeSlot extends Model
{
    protected $fillable = [
        'event_id', 'start_time', 'end_time', 'capacity', 'registered_count'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }

    public function getAvailableSlotsAttribute(): int
    {
        return $this->capacity - $this->registered_count;
    }

    public function getIsFullAttribute(): bool
    {
        return $this->registered_count >= $this->capacity;
    }
}
