<?php

namespace App;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class process extends Model
{
    protected $fillable = [
        'name','detail','familles_id'
    ];
    public function indicatorsprocs()
    {
      return $this->belongsToMany('App\indicatorsproc');
    }}
