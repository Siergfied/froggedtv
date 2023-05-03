<?php

namespace App\Http\Controllers;

use App\Models\ToolmixPlayer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ToolmixPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('toolmix_player.index', [
            'players' => ToolmixPlayer::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('toolmix_player.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required'],
            'commentaire' => ['nullable']
        ]);

        $toolmixPlayer = new ToolmixPlayer;
        $toolmixPlayer->user_id = Auth::user()->id;

        $toolmixPlayer->fill([
            'safe_lane' => $request->has('role.safe_lane'),
            'mid_lane' => $request->has('role.mid_lane'),
            'off_lane' => $request->has('role.off_lane'),
            'soft_support' => $request->has('role.soft_support'),
            'hard_support' => $request->has('role.hard_support'),
            'commentaire' => $request->commentaire,
        ]);
        $toolmixPlayer->save();

        return redirect(route('toolmixPlayer.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ToolmixPlayer $toolmixPlayer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): View
    {
        $toolmixPlayer = $request->user()->toolmixPlayer;

        return view('toolmix_player.edit', [
            'toolmixPlayer' => $toolmixPlayer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $toolmixPlayer = $request->user()->toolmixPlayer;

        $request->validate([
            'role' => ['required'],
            'commentaire' => ['nullable']
        ]);

        $toolmixPlayer->update([
            'safe_lane' => $request->has('role.safe_lane'),
            'mid_lane' => $request->has('role.mid_lane'),
            'off_lane' => $request->has('role.off_lane'),
            'soft_support' => $request->has('role.soft_support'),
            'hard_support' => $request->has('role.hard_support'),
            'commentaire' => $request->commentaire,
        ]);

        return redirect(route('toolmixPlayer.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $toolmixPlayer = $request->user()->toolmixPlayer;

        $toolmixPlayer->delete();

        return redirect(route('toolmixPlayer.index'));
    }
}
