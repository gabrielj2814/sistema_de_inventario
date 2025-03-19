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

        // $users




        return ApiResponse::success(null,"ok",200);
    }
}
