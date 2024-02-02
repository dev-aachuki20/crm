<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\PasswordReset;
use Exception;

class User extends Authenticatable
{
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'username',
        'email',
        'password',
        'birthdate',
        'campaign_id',
        'send_password_on_email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function uploads()
    {
        return $this->morphMany(Uploads::class, 'uploadsable');
    }

    public function getIsSuperAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getIsAdministratorAttribute()
    {
        return $this->roles()->where('id', 2)->exists();
    }

    public function getIsVendedorAttribute()
    {
        return $this->roles()->where('id', 3)->exists();
    }

    public function getIsSuperviorAttribute()
    {
        return $this->roles()->where('id', 4)->exists();
    }

    public function profileImage()
    {
        return $this->morphOne(Uploads::class, 'uploadsable')->where('type', 'profile');
    }

    public function getProfileImageUrlAttribute()
    {
        if ($this->profileImage) {
            return $this->profileImage->file_url;
        }
        return "";
    }

    public function sendPasswordResetNotification($token): void
    {
        try {
            $data = [
                $this->email
            ];
            $url = \URL::to('/password/reset/' . $token . '?email=' . $this->email);

            \Mail::send('emails.reset-password', [
                'fullname'      => $this->name,
                'reset_url'     => $url,
                'email'         => $this->email,
            ], function ($message) use ($data) {
                $message->subject('Reset Password Request');
                $message->to($data[0]);
            });
        } catch (Exception $e) {
            // Handle the exception here
            \Log::error('Error sending password reset email: ' . $e->getMessage());
            // You might want to notify the user or perform other actions
        }
    }
    public function isAssignedRole($roleId)
    {
        return $this->roles->contains('id', $roleId);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
}
