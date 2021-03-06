<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];


    /**
   * Define relationship with post model
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function tickets()
  {
     $this->hasMany(Ticket::class);
  }


}
