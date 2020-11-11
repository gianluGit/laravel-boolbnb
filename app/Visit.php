<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{

  protected $fillable = [

       'suite_views',
       'suite_id'

  ];

  public function suite() {

    return $this -> belongsTo(Suite::class);

  }
}
