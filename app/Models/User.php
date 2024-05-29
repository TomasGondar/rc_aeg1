<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'recoveryEmail', // Adicione os atributos adicionais necessários aqui
        'palavrapasse',
        'numerodeprocesso',
        'number',
        'classRoom'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * Determine if the user is a student.
     *
     * @return bool
     */
    public function isStudent()
    {
        // Você pode ajustar a lógica conforme necessário
        return strpos($this->email, '@aeg1.pt') !== false;
    }

    /**
     * Determine if the user is a teacher.
     *
     * @return bool
     */
    public function isTeacher()
    {
        // Você pode ajustar a lógica conforme necessário
        return !$this->isStudent();
    }
}
