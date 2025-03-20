<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function __construct(
        protected UserServices $userServices
    ){}

    public function consultAll(Request $request):JsonResponse{

        $users=$this->userServices->consultAll();

        return ApiResponse::success($users,"ok",200);
    }

    public function consultUserForId(Request $request):JsonResponse{

        $user=$this->userServices->consultUserForId($request->id);

        if(!$user){
            $mensaje="The user was not found";
            return ApiResponse::error($mensaje,404);
        }


        return ApiResponse::success($user,"ok",200);
    }

}
