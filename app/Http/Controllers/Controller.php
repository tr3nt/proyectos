<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $data;

    public function respond() : JsonResponse {
        
        $params = ["data" => $this->data[0]];
        $status = $this->data[1];

        return response()->json($params, $status);
    }

    public function authRespond() : JsonResponse {
        
        $params = [
            "data" => $this->data[0],
            "access_token" => $this->data[2],
            "token_type" => "Bearer"
        ];
        $status = $this->data[1];

        return response()->json($params, $status);
    }
}
