<?php

use App\User;

function current_user(): ?User
{
    return Auth::user();
}

function flash(string $field = null)
{
    if (!$field) {
        return Session::get('flash_message');
    }

    return Session::get('flash_message')[$field] ?? null;
}

function flash_error(string $message)
{
    flash_message($message, 'danger');
}

function flash_info(string $message)
{
    flash_message($message, 'info');
}

function flash_message(string $message, string $type = 'info') {
    Session::flash('flash_message', [
        'message' => $message,
        'type' => $type,
    ]);
}
