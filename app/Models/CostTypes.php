<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostTypes extends Model {

    protected $table = 'cost_types';
	
	protected $appends = ['type'];    

    // public function subchildren(){
    //     return $this->hasMany('App\Models\CostTypes','parent_id','id');
    // }

    public function children(){
    	return $this->hasMany(CostTypes::class,'parent_id','id')->with('children');
    }

    public function getTypeAttribute() {
        return 'cost';
    }
}
