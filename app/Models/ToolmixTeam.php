<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ToolmixTeam extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hard_support',
        'soft_support',
        'off_lane',
        'mid_lane',
        'safe_lane',
        'description'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
