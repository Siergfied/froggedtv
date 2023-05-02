<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('user.index', [
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Handled in Auth/RegisteredUserController
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Handled in Auth/RegisteredUserController
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user_id): View
    {
        $user = User::findOrFail($user_id);

        return view('user.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($user_id): View
    {
        $user = User::findOrFail($user_id);
        $this->authorize('update', $user);

        return view('user.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user_id): RedirectResponse
    {
        $user = User::findOrFail($user_id);

        $this->authorize('update', $user);

        $validated = $request->validate([
            'pseudo' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
            'description' => ['nullable'],
            'steam' => ['string', 'max:255', 'nullable', 'regex:/(?<CUSTOMPROFILE>https?\:\/\/steamcommunity.com\/id\/[A-Za-z_0-9]+\/)|(?<CUSTOMURL>\/id\/[A-Za-z_0-9]+)|(?<PROFILE>https?\:\/\/steamcommunity.com\/profiles\/[0-9]+\/)/i'],
            'discord' => ['string', 'max:255', 'regex:/^.{3,32}#[0-9]{4}$/i', 'nullable'],
            'twitter' => ['string', 'max:255', 'nullable', 'regex:/(?:https?:)?\/\/(?:www\.|m\.)?twitter\.com\/(\w{2,15})\/?(?:\?\S+)?(?:\#\S+)?$/i'],
            'mmr' => ['numeric', 'min:0', 'nullable'],
        ]);

        if ($request->hasFile('avatar')) {
            $image = Image::make($request->file('avatar'));
            $filename = 'user_' . $user_id . '.webp';

            $imageFull = $image->encode('webp', 90);
            Storage::disk('public')->put('user/full/' . $filename, $imageFull);

            $imageResized = $image->resize(400, 400)->encode('webp', 90);
            Storage::disk('public')->put('user/avatar/' . $filename, $imageResized);
        };

        $user->update($validated);

        return Redirect::route('user.edit', $user_id)->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
