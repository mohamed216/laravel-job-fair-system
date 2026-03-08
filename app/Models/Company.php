<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'name', 'logo', 'description',
        'contact_email', 'contact_phone', 'booth_number'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(CompanyVisit::class);
    }

    public function visitedApplicants(): HasMany
    {
        return $this->hasMany(CompanyVisit::class);
    }
}
