<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
        'verifiy_code',
        'code_expire_at',
        'email_verified_at',
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

    public function GenerateCode()
    {
        $this->verifiy_code = rand(1111, 9999);
        $this->code_expire_at = date_modify(date_create(), "+15 minute");
        $this->save();
        return $this;
    }
    public function VerifyDone()
    {
        $this->verifiy_code = null;
        $this->code_expire_at = null;
        $this->email_verified_at = now();
        $this->save();
    }
    public function Sections()
    {
        return $this->hasMany(Section::class, 'Created_By', 'id');
    }
}
