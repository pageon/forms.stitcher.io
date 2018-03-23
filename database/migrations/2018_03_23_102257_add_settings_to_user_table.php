<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSettingsToUserTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('redirect_to')->nullable();
            $table->string('throttle_redirect_to')->nullable();
            $table->string('allowed_site')->nullable();
        });
    }
}
