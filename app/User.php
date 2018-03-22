<?php

namespace App;

use App\Mail\UserActivationMail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
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
            self::setUuid($user);

            self::setActivationToken($user);
        });

        self::created(function (User $user) {
            $user->sendActivationMail();
        });
    }

    public function sendActivationMail()
    {
        Mail::to($this)->send(new UserActivationMail($this));
    }

    public function forms(): HasMany
    {
        return $this->hasMany(Form::class);
    }

    public function activate(): self
    {
        $this->is_active = 1;
        $this->activation_token = null;

        $this->save();

        return $this;
    }

    private static function setUuid(User $user)
    {
        if ($user->uuid) {
            return;
        }

        $user->uuid = Uuid::uuid4();
    }

    private static function setActivationToken(User $user)
    {
        if ($user->activation_token) {
            return;
        }

        $user->activation_token = Uuid::uuid4();
    }
}
