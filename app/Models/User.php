<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function tutorials()
    {
      return $this->hasMany('App\Models\Tutorial');
    }

    public function comments()
    {
      return $this->hasMany('App\Models\Comment');
    }

    public function notifications()
    {
      return $this->hasMany('App\Models\Notification');
    }
    public function tags()
    {
      return $this->belongsToMany('App\Models\Tag');
    }
}
