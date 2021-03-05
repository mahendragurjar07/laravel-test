<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Costs extends Model {

    protected $table = 'costs';
    
    protected $appends = ['type'];

    public function children(){
        return $this->hasOne('App\Models\CostTypes','id','cost_type_id');
    }

    public function getTypeAttribute() {
        return 'cost';
    } 
}
