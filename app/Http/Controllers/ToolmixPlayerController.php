<?php

namespace App\Http\Controllers;

use App\Models\ToolmixPlayer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ToolmixPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('toolmix_player.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('toolmix_player.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        dd($request);
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
    public function edit(ToolmixPlayer $toolmixPlayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ToolmixPlayer $toolmixPlayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ToolmixPlayer $toolmixPlayer)
    {
        //
    }
}
