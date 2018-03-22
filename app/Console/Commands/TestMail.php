<?php

namespace App\Console\Commands;

use App\Mail\UserActivationMail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMail extends Command
{
    protected $signature = 'test:mail';
    protected $description = 'Test a mail';

    public function handle()
    {
        $user = User::firstOrFail();

        Mail::to('brendt@stitcher.io')->send(new UserActivationMail($user));

        $this->info('Mail was sent!');
    }
}
