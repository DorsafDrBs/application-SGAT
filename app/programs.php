<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class programs extends Model
{
    protected $fillable = ['program' ];
   
    public function perimetres() {
        return $this->hasMany(perimetre::class);
      }
}
