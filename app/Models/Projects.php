<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model {

    protected $table = 'projects';
 	
 	protected $appends = ['type'];

 	public function children(){
        return $this->hasMany('App\Models\Costs','project_id','id');
    }

    public function children1(){
        return $this->hasMany('App\Models\CostTypes','project_id','id');
    }

    public function getTypeAttribute() {
        return 'project';
    }  
}
