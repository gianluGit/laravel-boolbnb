<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suite extends Model
{

  protected $fillable = [

       'title',
       'room_number',
       'bed_number',
       'bathroom_number',
       'meters',
       'city',
       'street',
       'postal_code',
       'latitude',
       'longitude',
       'picture',
       'visible',
       'user_id'

  ];

  public function comforts() {

    return $this -> belongsToMany(Comfort::class);

  }

  public function user() {

    return $this -> belongsTo(User::class);

  }

  public function messages() {

    return $this -> hasMany(Message::class);

  }

  public function visit() {

    return $this -> belongsTo(Visit::class); // Avevamo hasMany

  }

  public function promotions() {

    return $this -> belongsToMany(Promotion::class) -> withTimestamps() -> withPivot('start_date', 'end_date');

  }

}
