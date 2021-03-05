<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ExplorerRepository;

class ExplorerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Api Controller
    |--------------------------------------------------------------------------
    */

    public function get(Request $request){
        try {

            $result = ExplorerRepository::get($request);
            return response()->json(
                [
                    'success' => true,
                    'data' => $result,
                    'message' => ''
                ],
                200
            );

        } catch (\Exception $ex) {
            return response()->json(
                [
                    'success' => false,
                    'data' => '',
                    'message' => $ex->getMessage()
                ],
                400
            );
        }

    }


}
