<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicatorsproc extends Model
{
    protected $fillable = ['name' ,'detail'];
    public function processes()
    {
        return $this->belongsTo('App\process');
       
    }
}
