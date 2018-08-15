<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $fillable = [
      'title'
  ];

  public function tutorials()
  {
    return $this->belongsToMany('App\Models\Tutorial');
  }
}
