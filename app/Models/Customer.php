<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'phone',
        'address',
        'image',
        'status',
        'number'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->number = now()->timestamp;
        });
    }

      /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    protected $primaryKey = 'id';
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
