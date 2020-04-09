<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class taches extends Model
{
    protected $fillable = ['name' ];


    public function programs() {
        return $this->hasMany(programs::class)->select('id','program');
      }


}

