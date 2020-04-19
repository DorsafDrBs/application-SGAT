<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project_has_taches extends Model
{
    protected $fillable = ['projects_id','perimetre_id' ];
    public function users()
    {
        return $this->belongsToMany(User::class,'project_has_users','projects_id','users_id');
    }
}
