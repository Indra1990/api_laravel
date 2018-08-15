<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $guarded = ['id'];

  public function user()
  {
    return $this->belongTo('App\Models\User');
  }

  public function tutorial()
  {
    return $this->belongsTo('App\Models\Tutorial');
  }

}
