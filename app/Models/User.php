<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\PasswordReset;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable implements MustVerifyEmail
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
        'created_by',
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

    protected static function boot()
    {
        parent::boot();
        static::creating(function(User $model) {
            $model->created_by = auth()->user()->id;
        });

    }

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

    public function getIsSuperviorAttribute()
    {
        return $this->roles()->where('id', 3)->exists();
    }

    public function  getIsVendorAttribute()
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
            $url = \URL::to('/password/reset/' . $token . '?email=' . $this->email);

            Mail::send('emails.reset-password', [
                'fullname'      => $this->name,
                'reset_url'     => $url,
                'email'         => $this->email,
            ], function ($message) {
                $message->subject('Reset Password Request');
                $message->to($this->email);
            });

        } catch (Exception $e) {
            \Log::error('Error sending password reset email: ' . $e->getMessage());
        }
    }

    public function NotificationSendToVerifyEmail()
    {
        $user = $this;

        $url = URL::temporarySignedRoute(
            'verification.verify',
            \Carbon\Carbon::now()->addMinutes(config('auth.verification.expire', 60)), // Adjust the expiration time as needed
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        // $url =  route('verification.verify',['id'=>$user->id,'hash'=>sha1($user->email)]);

        $subject = 'Verify Email Address';

        Mail::to($user->email)->queue(new VerifyEmailMail($user->name, $url, $subject));
    }

    public function isAssignedRole($roleId)
    {
        return $this->roles->contains('id', $roleId);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'user_campaign');
    }

}
