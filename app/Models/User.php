<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Wuwx\LaravelAutoNumber\AutoNumberTrait;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, AutoNumberTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = false; //set to false, otherwise the primary key will incrementing
    protected $primaryKey = 'kode_user';
    protected $table = 'users';
    protected $fillable = [
        'kode_user',
        'nama_lengkap',
        'jenis_kelamin',
        'level',
        'email',
        'hp',
        'is_verified',
        'username',
        'password',
        'foto',
        'alamat',
        'telegram_id',
        'device_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function findForPassport($identifier)
    {
        return $this->orWhere('email', $identifier)->orWhere('username', $identifier)->first();
    }

    public function getAutoNumberOptions()
    {
        return [
            'kode_user' => [
                'format' => 'USER?', // Format kode yang akan digunakan.
                'length' => 3 // Jumlah digit yang akan digunakan sebagai nomor urut
            ]
        ];
    }
}
