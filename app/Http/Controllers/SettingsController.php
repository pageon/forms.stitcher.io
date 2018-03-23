<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettings;
use Illuminate\Http\Response;

class SettingsController
{
    public function index()
    {
        $user = current_user();

        abort_unless($user !== null, Response::HTTP_NOT_FOUND);

        return view('settings.index', [
            'user' => $user,
        ]);
    }

    public function store(StoreSettings $request)
    {
        $user = current_user();

        abort_unless($user !== null, Response::HTTP_NOT_FOUND);

        $user->fill($request->validated());

        $user->save();

        flash_info(__('Settings successfully saved.'));

        return redirect()->route('settings.index');
    }
}
