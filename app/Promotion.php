<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
  protected $fillable = [

    'name',
    'price',
    'duration'

  ];

  public function suites() {

    return $this -> belongsToMany(Suite::class) -> withTimestamps() -> withPivot('start_date', 'end_date');

  }
}
