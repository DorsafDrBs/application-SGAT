<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicatorsproc extends Model
{
    protected $fillable = ['name' ,'detail','process_id'];
    public function processes()
    {
        return $this->belongsTo('App\process');
       
    }
}
