<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active',
        'name',
        'password',
        'email',
        'cellphone',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];


    //--------------------------------------------------
    // Relacionamentos
    //--------------------------------------------------

    /**
     * Relacionamento com Posts
     *
     * @return lluminate\Database\Eloquent\Collection
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //--------------------------------------------------
    // Accessors & Mutators
    //--------------------------------------------------

    /**
     * Hash the password.
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
