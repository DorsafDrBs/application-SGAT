<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hours_users extends Model
{
    protected $fillable = [ 'annee' ,'semaine' ,'mois' ,'trimestre' ,'h_r_rl' ,'h_r_est','h_fact','project_id','users_id'];
}
