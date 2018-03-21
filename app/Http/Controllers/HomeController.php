<?php

namespace App\Http\Controllers;

use App\FormTable;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $table = new FormTable($user->forms->toArray());

        return view('home', compact('user', 'table'));
    }
}
