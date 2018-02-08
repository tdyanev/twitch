<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
  public function scopeVisible($q) {
    return $q->where('visible', 1);
  }

  public function scopeOrder($q) {
    return $q->orderBy('order', 'desc');
  }
    //
  public $timestamps = false;
}
