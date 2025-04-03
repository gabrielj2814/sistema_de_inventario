<?php

namespace App\Http\Controllers;

use App\Contracts\User;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreateCustomerFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //

    public function __construct(
        protected User $user
    ){}



    public function register(CreateCustomerFormRequest $request):JsonResponse{

        $data=[
            "name"       => $request->customer->name,
            "last_name"  => $request->customer->last_name,
            "email"      => $request->customer->email,
            "password"   => $request->customer->password,
            "name_company" => $request->customer->name_company,
            "phone_company" => $request->customer->phone_company,
            "email_company" => $request->customer->email_company,
        ];





        return ApiResponse::success($data,"ok",200);


    }



}
