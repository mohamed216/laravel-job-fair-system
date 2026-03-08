<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applicant extends Model
{
    protected $fillable = [
        'event_id', 'time_slot_id', 'name', 'email', 'phone',
        'education', 'experience', 'skills', 'qr_code', 'status'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function companyVisits(): HasMany
    {
        return $this->hasMany(CompanyVisit::class);
    }
}
