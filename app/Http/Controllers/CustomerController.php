<?php

namespace App\Http\Controllers;

use App\Contracts\User;
use App\Events\CreatedCustomerEvent;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreateCustomerFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            "address_company" => $request->customer->address_company,
        ];


        DB::beginTransaction();

        try {
            $user=$this->user->create($data);

            $companyData=[
                "name" => $request->customer->name_company,
                "phone" => $request->customer->phone_company,
                "email" => $request->customer->email_company,
                "address" => $request->customer->address_company,
            ];

            $dataEvent=[
                "user" => $user,
                "companyData" => $companyData,
            ];

            CreatedCustomerEvent::dispatch($dataEvent);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Log::error("Error register customer",[
                "error" => $th->getMessage(),
                "data" => $data
            ]);
            return ApiResponse::error("Error register customer",500);
        }







        return ApiResponse::success($data,"ok",200);


    }



}
