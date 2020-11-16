<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = [

    'email_sender',
    'content',
    'suite_id'

  ];

  public function suite() {

    return $this -> belongsTo(Suite::class);

  }

}
