<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projects extends Model
{
    protected $fillable = ['project_name','proc_id' ];

    public function projectindicator()
    {
        return $this->belongsToMany(indicatorsproj::class,'indicatorsproj_value','projects_id','indicatorsproj_id','value','target');
    }
    public function projectusers()
    {
        return $this->belongsToMany(User::class,'project_has_users','users_id','projects_id');
    }
    public function projectuserindicator()
    {
        return $this->belongsToMany(indicatorsproj::class,'indicatorsusers_value','users_id','indicatorsproj_id','value','target');
    }
    public function indicatorprojects()
    {
        return $this->hasMany(indicatorsproj::class);}
}
