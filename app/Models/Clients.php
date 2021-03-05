<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model {

    protected $table = 'clients';
    
    protected $appends = ['type'];

    public function children(){
        return $this->hasMany('App\Models\Projects','client_id','id');
    }

    public function getTypeAttribute() {
        return 'client';
    }
}
