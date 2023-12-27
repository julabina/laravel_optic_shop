<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $message = '';

        if ($request->session()->has('profilMessage')) {
            $messages = $request->session()->pull('profilMessage');
        }

        $user = User::where('id', $request->user()->id)->with('address', 'company')->first();

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'user' => $user,
            'message' => $message,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    public function updateMail(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
            'email' => ['required', 'email'],
        ]);

        $user = $request->user();

        $user->email = $request->email;
        $user->save();

        return Redirect(Route('profile.edit'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        /*  $request->validate([
             'password' => ['required', 'current_password'],
         ]);

         $user = $request->user();

         Auth::logout();

         $user->delete();

         $request->session()->invalidate();
         $request->session()->regenerateToken(); */

        return Redirect::to('/');
    }
}
