<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        self::saving(function (User $user) {
            if ($user->uuid) {
                return;
            }

            $user->uuid = Uuid::uuid4();
        });
    }

    public function forms(): HasMany
    {
        return $this->hasMany(Form::class);
    }
}
