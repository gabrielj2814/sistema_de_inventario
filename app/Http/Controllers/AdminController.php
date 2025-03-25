<?php

namespace App\Http\Controllers;

use App\Contracts\Admin;
use App\Contracts\User;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreateAdminFormRequest;
use App\Http\Requests\UpdateAdminFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function __construct(
        protected User $user
    ){}

    public function consultAll(Request $request):JsonResponse{

        $users=$this->user->consultAll();

        return ApiResponse::success($users,"ok",200);
    }

    public function consultUserForId(Request $request):JsonResponse{

        $user=$this->user->consultForId($request->id);

        if(!$user){
            $mensaje="The user was not found";
            return ApiResponse::error($mensaje,404);
        }

        return ApiResponse::success($user,"ok",200);
    }

    public function createdUser(CreateAdminFormRequest $request):JsonResponse{

        $data=[
            "name"       => $request->admin->name,
            "last_name"  => $request->admin->last_name,
            "email"      => $request->admin->email,
        ];

        $createdUser=$this->user->create($data);

        return ApiResponse::success($createdUser,"User was created successfully",200);
    }

    public function updatedUser(UpdateAdminFormRequest $request, $id):JsonResponse{

        $data=[
            "id"         => $request->admin->id,
            "name"       => $request->admin->name,
            "last_name"  => $request->admin->last_name,
        ];

        if($request->admin->id!=$id){
            $mensaje="the id of the request is different from the id of the data";
            return ApiResponse::error($mensaje,404);
        }

        $updatedUser=$this->user->edit($data);

        return ApiResponse::success($updatedUser,"User was updated successfully",200);
    }


}
