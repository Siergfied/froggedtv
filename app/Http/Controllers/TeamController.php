<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('user_and_team.team.index', [
            'teams' => Team::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('user_and_team.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tag' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'ingame_id' => ['nullable', 'numeric']
        ]);

        $team = new Team;
        $team->captain_id = Auth::user()->id;
        $team->password = Hash::make($request->password);
        $team->fill([
            'name' => $request->name,
            'tag' => $request->tag,
        ]);
        $team->save();

        //assign created team to user
        $user = $request->user();
        $user->team()->associate($team)->save();

        $event = new TeamEvent();
        $event->team_id = $team->id;
        $event->user_id = Auth::user()->id;
        $event->date = Carbon::now();
        $event->event = TeamEvent::EVENT_CREATE;
        $event->save();

        return redirect(route('team.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($team_id): View
    {
        $team = Team::find($team_id);

        $captain = User::findMany($team->captain_id);
        $vice_captain = User::findMany($team->vice_captain_id);
        $players = User::where('team_id', $team_id)->get()->whereNotIn('id', [$team->captain_id, $team->vice_captain_id, $team->coach_id]);
        $coach = User::findMany($team->coach_id);

        $users = $captain->merge($vice_captain)->merge($players)->merge($coach);

        return view('user_and_team.team.show', [
            'team' => $team,
            'users' => $users,
            'events' => TeamEvent::where('team_id', $team_id)->orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($team_id)
    {
        $team = Team::findOrFail($team_id);

        $this->authorize('update', $team);

        return view('user_and_team.team.edit', [
            'team' => $team
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $team_id)
    {
        $this->authorize('update', $team_id);

        $team = Team::findOrFail($team_id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tag' => ['required', 'string', 'max:255'],
        ]);

        $team->update([
            'name' => $request->name,
            'tag' => $request->tag,
        ]);

        return redirect(route('team.show', $team_id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }

    /**
     * Add the specified user to the specified resource from storage.
     */
    public function join(Request $request, $team_id): RedirectResponse
    {
        $user = $request->user();
        $teamMember = User::where('team_id', $team_id)->count();
        $team = Team::find($team_id);

        $request->validate([
            'password' => ['required', 'string']
        ]);

        if (Hash::check($request->password, $team->password)) {
            $user->team()->associate($team)->save();
        } else {
            throw ValidationException::withMessages([
                'password' => 'Mot de passe incorrect !',
            ]);
        }

        if ($teamMember == 0) {
            $team->captain_id = $user->id;
            $team->save();
        }

        $event = new TeamEvent();
        $event->team_id = $team_id;
        $event->user_id = Auth::user()->id;
        $event->date = Carbon::now();
        $event->event = TeamEvent::EVENT_JOIN;
        $event->save();

        return redirect(route('team.show', $team_id));
    }

    /**
     * Remove the specified user from team and remove role.
     */
    public function leave(Request $request, $team_id): RedirectResponse
    {
        $user = $request->user();
        $teamMember = User::where('team_id', $team_id)->count();
        $team = Team::find($team_id);

        if ($teamMember != 1 && $user->id == $team->captain_id) {
            return redirect(route('team.show', $team_id));
        }

        switch ($user->id) {
            case $user->id == $team->captain_id:
                $team->captain_id = null;
            case $user->id == $team->vice_captain_id:
                $team->vice_captain_id = null;
            case $user->id == $team->coach_id:
                $team->coach_id = null;
        }

        $team->save();

        $user->team()->dissociate()->save();

        $event = new TeamEvent();
        $event->team_id = $team_id;
        $event->user_id = Auth::user()->id;
        $event->date = Carbon::now();
        $event->event = TeamEvent::EVENT_LEAVE;
        $event->save();

        return redirect(route('team.index'));
    }

    /**
     * Remove the specified user from team and remove role.
     */
    public function kick($user_id): RedirectResponse
    {
        $user = User::find($user_id);
        $team = Team::find($user->team_id);

        $this->authorize('update', $team);

        switch ($user->id) {
            case $user->id == $team->vice_captain_id:
                $team->vice_captain_id = null;
            case $user->id == $team->coach_id:
                $team->coach_id = null;
        }

        $team->save();
        $user->team()->dissociate()->save();

        $event = new TeamEvent();
        $event->team_id = $team->id;
        $event->user_id = $user_id;
        $event->date = Carbon::now();
        $event->event = TeamEvent::EVENT_KICK;
        $event->save();

        return redirect(route('team.show', $team->id));
    }

    public function updateCaptain(Request $request, $user_id): RedirectResponse
    {
        $user = User::find($user_id);
        $team = Team::find($user->team_id);

        $this->authorize('update', $team);

        $request->validate([
            'password' => ['required', 'string']
        ]);

        if (Hash::check($request->password, $team->password)) {
            $team->captain_id = $user_id;
            if ($team->vice_captain_id == $user_id) {
                $team->vice_captain_id = null;
            }
            $team->save();
        } else {
            throw ValidationException::withMessages([
                'password' => 'Mot de passe incorrect !',
            ]);
        }

        $event = new TeamEvent();
        $event->team_id = $team->id;
        $event->user_id = $user_id;
        $event->date = Carbon::now();
        $event->event = TeamEvent::EVENT_UPDATE_CAPTAIN;
        $event->save();

        return redirect(route('team.show', $team->id));
    }

    public function updateViceCaptain($user_id): RedirectResponse
    {
        $user = User::find($user_id);
        $team = Team::find($user->team_id);

        $this->authorize('update', $team);

        if ($team->captain_id != $user_id) {
            $team->vice_captain_id = $user_id;
            $team->save();
        }

        $event = new TeamEvent();
        $event->team_id = $team->id;
        $event->user_id = $user_id;
        $event->date = Carbon::now();
        $event->event = TeamEvent::EVENT_UPDATE_VICE_CAPTAIN;
        $event->save();

        return redirect(route('team.show', $team->id));
    }

    public function removeViceCaptain($user_id): RedirectResponse
    {
        $user = User::find($user_id);
        $team = Team::find($user->team_id);

        $this->authorize('update', $team);

        $team->vice_captain_id = null;
        $team->save();

        $event = new TeamEvent();
        $event->team_id = $team->id;
        $event->user_id = $user_id;
        $event->date = Carbon::now();
        $event->event = TeamEvent::EVENT_REMOVE_VICE_CAPTAIN;
        $event->save();

        return redirect(route('team.show', $team->id));
    }

    public function updateCoach($user_id): RedirectResponse
    {
        $user = User::find($user_id);
        $team = Team::find($user->team_id);

        $this->authorize('update', $team);

        $team->coach_id = $user_id;
        $team->save();

        $event = new TeamEvent();
        $event->team_id = $team->id;
        $event->user_id = $user_id;
        $event->date = Carbon::now();
        $event->event = TeamEvent::EVENT_UPDATE_COACH;
        $event->save();

        return redirect(route('team.show', $team->id));
    }

    public function removeCoach($user_id): RedirectResponse
    {
        $user = User::find($user_id);
        $team = Team::find($user->team_id);

        $this->authorize('update', $team);

        $team->coach_id = null;
        $team->save();

        $event = new TeamEvent();
        $event->team_id = $team->id;
        $event->user_id = $user_id;
        $event->date = Carbon::now();
        $event->event = TeamEvent::EVENT_REMOVE_COACH;
        $event->save();

        return redirect(route('team.show', $team->id));
    }
}
