<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class projects extends Model
{
    protected $fillable = ['project_name','proc_id' ];
    
    public function users()
    {
        return $this->belongsToMany(User::class,'project_has_users','projects_id','users_id');
    }
    public function perimetres() {

        return $this->belongsToMany(perimetre::class, 'project_has_taches');
    }






    public function projectindicator()
    {
        return $this->belongsToMany(indicatorsproj::class,'indicatorsproj_value','projects_id','indicatorsproj_id','value','target');
    }
  
    public function projectuserindicator()
    {
        return $this->belongsToMany(indicatorsproj::class,'indicatorsusers_value','users_id','indicatorsproj_id','value','target');
    }
    public function indicatorprojects()
    {
        return $this->hasMany(indicatorsproj::class);
    }
}
