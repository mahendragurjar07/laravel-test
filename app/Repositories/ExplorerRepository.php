<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\Clients;
use DB;

class ExplorerRepository {

    /**
     * Get list of explorer
     */ 
    public static function get($request) {
        try{
            //print_r($request->client_id);die;
            $clientQuery = Clients::with(['children'=>function($q) use ($request){ // projects
                $q->select('id','title as name','client_id');
                // cost amount
                $q->withCount(['children as amount' => function($query) use ($request) {
                    $query->select(DB::raw('sum(amount)'));
                    if(!empty($request->project_id)){
                        $query->whereIn('id',$request->project_id);
                    }
                }]);

                if(!empty($request->project_id)){
                    $q->whereIn('id',$request->project_id);
                }

                // cost
                $q->with(['children'=>function($q1) use ($request){
                    $q1->select('costs.id','cost_types.name','project_id','cost_type_id');
                    $q1->join('cost_types', function($join)
                    {
                        $join->on('cost_types.id', '=', 'costs.cost_type_id');
                        $join->whereNull('cost_types.parent_id');
                        
                    });

                    if(!empty($request->cost_type_id)){
                        $q1->whereIn('cost_types.id',$request->cost_type_id);
                    }

                    $q1->with(['children.children'=>function($q2) use ($request){
                        if(!empty($request->cost_type_id)){
                            $q2->whereIn('id',$request->cost_type_id);
                        }
                    }]);

                }]);

            }])
            ->withCount(['children as amount' => function($q) use ($request){
                $q->select(DB::raw('sum(costs.amount)'));
                $q->join('costs','costs.project_id','=','projects.id');
                if(!empty($request->client_id)){
                    $q->whereIn('costs.cost_type_id',$request->client_id);
                }
            }]);
            if(!empty($request->client_id)){
                $clientQuery->whereIn('id',$request->client_id);
            }
            $clients = $clientQuery->get();

            return $clients;

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
