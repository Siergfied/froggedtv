<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamEvent extends Model
{
    use HasFactory;

    const EVENT_CREATE = 'CREATE';
    const EVENT_JOIN = 'JOIN';
    const EVENT_LEAVE = 'LEAVE';
    const EVENT_KICK = 'KICK';
    const EVENT_UPDATE_CAPTAIN = 'PROMOTE_CAPTAIN';
    const EVENT_UPDATE_VICE_CAPTAIN = 'PROMOTE_VICE_CAPTAIN';
    const EVENT_REMOVE_VICE_CAPTAIN = 'DEMOTE_VICE_CAPTAIN';
    const EVENT_UPDATE_COACH = 'PROMOTE_COACH';
    const EVENT_REMOVE_COACH = 'DEMOTE_COACH';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
