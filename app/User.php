<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTauth\Contracts\JWTSubject;

class User extends Authenticatable 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Make realtionship between user and books, one user has many book.
     */

     public function books() {
         return $this->hasMany(Book::class);
     }

     public function getJWTIdentifier() {
         return $this->getKey();
     }

     public function getJWTCustomClaims() {
         return [];
     }
}
