<?php

use App\User;

function current_user(): ?User
{
    return Auth::user();
}
