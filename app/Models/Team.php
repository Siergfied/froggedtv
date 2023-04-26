<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

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
        'name',
        'tag',
        'logo',
        'ingame_id',
        'captain_id',
        'vice-captain_id',
        'coach_id',
        'roster_locked'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function teamEvent(): HasMany
    {
        return $this->hasMany(TeamEvent::class);
    }

    public function toolmixTeam(): BelongsTo
    {
        return $this->belongsTo(ToolmixTeam::class);
    }
}
