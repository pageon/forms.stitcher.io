<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;

class ActivationController
{
    public function activate(string $activationToken)
    {
        /** @var \App\User $user */
        $user = User::query()
            ->where('activation_token', $activationToken)
            ->where('is_active', 0)
            ->firstOrFail();

        $user->activate();

        Auth::login($user);

        flash_info('Your account has been activated!');

        return redirect()->route('home');
    }

    public function resend(string $activationToken)
    {
        /** @var \App\User $user */
        $user = User::query()
            ->where('activation_token', $activationToken)
            ->where('is_active', 0)
            ->firstOrFail();

        $user->sendActivationMail();

        flash_info("A new activation mail was sent to {$user->email}.");

        return redirect()->route('login');
    }
}
