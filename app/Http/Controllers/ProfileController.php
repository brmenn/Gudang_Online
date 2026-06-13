<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = $request->user();

        Log::info('Profile update attempt', [
            'user_id' => $user->id,
            'old_email' => $user->email,
            'new_email' => $validated['email'] ?? null,
        ]);

        if (isset($validated['email'])) {
            $user->email = $validated['email'];
            $user->email_verified_at = null;
        }

        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }

        $saved = $user->save();

        Log::info('Profile update result', ['saved' => $saved, 'email_now' => $user->fresh()->email]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
