<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comfort extends Model
{
  protected $fillable = [

    'title'

  ];

  public function suites() {

    return $this -> belongsToMany(Suite::class);

  }
}
