<?php

namespace App\Http\Controllers;

use App\Models\ToolmixTeam;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ToolmixTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //dd(ToolmixTeam::with('team')->get());
        return view('toolmix_team.index', [
            'teams' => ToolmixTeam::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', ToolmixTeam::class);

        return view('toolmix_team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', ToolmixTeam::class);

        $request->validate([
            'mmr_min' => ['numeric', 'min:0', 'nullable'],
            'mmr_max' => ['numeric', 'min:0', 'nullable'],
            'role' => ['required'],
            'commentaire' => ['nullable']
        ]);

        $toolmixTeam = new ToolmixTeam;
        $toolmixTeam->team_id = Auth::user()->team_id;

        $toolmixTeam->fill([
            'mmr_min' => $request->mmr_min,
            'mmr_max' => $request->mmr_max,
            'safe_lane' => $request->has('role.safe_lane'),
            'mid_lane' => $request->has('role.mid_lane'),
            'off_lane' => $request->has('role.off_lane'),
            'soft_support' => $request->has('role.soft_support'),
            'hard_support' => $request->has('role.hard_support'),
            'commentaire' => $request->commentaire,
        ]);
        $toolmixTeam->save();

        return redirect(route('toolmixTeam.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ToolmixTeam $toolmixTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {

        $toolmixTeam = $request->user()->team->toolmixTeam;

        $this->authorize('update', $toolmixTeam);

        return view('toolmix_team.edit', [
            'toolmixTeam' => $toolmixTeam,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToolmixTeam $toolmixTeam)
    {
        $toolmixTeam = $request->user()->team->toolmixTeam;

        $this->authorize('update', $toolmixTeam);

        $request->validate([
            'mmr_min' => ['numeric', 'min:0', 'nullable'],
            'mmr_max' => ['numeric', 'min:0', 'nullable'],
            'role' => ['required'],
            'commentaire' => ['nullable']
        ]);

        $toolmixTeam->update([
            'mmr_min' => $request->mmr_min,
            'mmr_max' => $request->mmr_max,
            'safe_lane' => $request->has('role.safe_lane'),
            'mid_lane' => $request->has('role.mid_lane'),
            'off_lane' => $request->has('role.off_lane'),
            'soft_support' => $request->has('role.soft_support'),
            'hard_support' => $request->has('role.hard_support'),
            'commentaire' => $request->commentaire,
        ]);

        return redirect(route('toolmixTeam.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $toolmixTeam = $request->user()->team->toolmixTeam;

        $this->authorize('update', $toolmixTeam);

        $toolmixTeam->delete();

        return redirect(route('toolmixTeam.index'));
    }
}
