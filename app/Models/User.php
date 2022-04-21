<?php

namespace App\Models;

use App\Mail\ResetPasswordEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class User extends Authenticatable {
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
        'public_api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function createApiToken() {
        $unhashedToken = Str::random(60);

        $this->api_token = hash('sha256', $unhashedToken);
        $this->public_api_token = $unhashedToken;

        $this->save();
    }

    public function deleteApiToken() {
        $this->api_token = null;
        $this->public_api_token = null;

        $this->save();
    }

    // Relation
    public function companyRecordRequests() {
        return $this->hasMany(CompanyRecordRequest::class);
    }

    // Overwrite default reset password email
    public function sendPasswordResetNotification($token) {
        Mail::to($this->email)->send(
            new ResetPasswordEmail($this, $token)
        );
    }
}
