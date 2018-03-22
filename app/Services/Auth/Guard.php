<?php

namespace App\Services\Auth;

use Illuminate\Auth\SessionGuard;

class Guard extends SessionGuard
{
    public function attempt(array $credentials = [], $remember = false)
    {
        $this->fireAttemptEvent($credentials, $remember);

        /** @var \App\User $user */
        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        if ($user && ! $user->is_active) {
            $resendLink = route('user.activate.resend', $user->activation_token);

            flash_error("This account isn't activated yet. Click <a href=\"{$resendLink}\">here</a> to resend the activation mail.");

            return false;
        }

        // If an implementation of UserInterface was returned, we'll ask the provider
        // to validate the user against the given credentials, and if they are in
        // fact valid we'll log the users into the application and return true.
        if ($this->hasValidCredentials($user, $credentials)) {
            $this->login($user, $remember);

            return true;
        }

        // If the authentication attempt fails we will fire an event so that the user
        // may be notified of any suspicious attempts to access their account from
        // an unrecognized user. A developer may listen to this event as needed.
        $this->fireFailedEvent($user, $credentials);

        return false;
    }
}
