<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicatorsproc extends Model
{
    protected $fillable = ['name' ,'detail','process_id','unit_id','target','orange','periodicity','min','max',
    'datasource'];
    public function processes()
    {
        return $this->belongsTo('App\process');
       
    }
}
