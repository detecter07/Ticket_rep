<?php

namespace App;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Ticket extends Model
{
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','content','user_id'
    ];

    /**
     * date format
     */
    protected $dateFormat = 'Y.m.d h:m:s';

        /**
   * Define relationship with post model
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function User()
  {
     $this->belongsTo(User::class);
  }


}
