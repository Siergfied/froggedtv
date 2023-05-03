<?php

namespace App\Policies;

use App\Models\ToolmixTeam;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ToolmixTeamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ToolmixTeam $toolmixTeam): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->team->captain_id == $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ToolmixTeam $toolmixTeam): bool
    {
        return $toolmixTeam->team->captain_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ToolmixTeam $toolmixTeam): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ToolmixTeam $toolmixTeam): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ToolmixTeam $toolmixTeam): bool
    {
        //
    }
}
