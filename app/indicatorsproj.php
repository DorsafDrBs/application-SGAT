<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indicatorsproj extends Model
{
    protected $fillable = ['name','detail' ];
    public function projects()
    {
        return $this->belongsToMany(Projects::class);
    }
}
