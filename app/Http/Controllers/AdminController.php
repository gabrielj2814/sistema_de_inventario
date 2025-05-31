<?php

namespace App\Http\Controllers;

use App\Contracts\Admin;
use App\Contracts\User;
use App\Events\CreatedAdminUserEvent;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreateAdminFormRequest;
use App\Http\Requests\UpdateAdminFormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AdminController extends Controller
{
    //


    public function __construct(
        protected User $user
    ){}

    public function viewIndex(Request $request){
        $rutas=Route::getRoutes()->getRoutesByName();
        $app_url=env("APP_URL");

        return Inertia::render("modules/personal_admin/PersonalAdminIndex",[
            "rutas" => $rutas,
            "app_url" => $app_url
        ]);
    }



    public function consultAll(Request $request):JsonResponse{

        $users=$this->user->consultAll();

        return ApiResponse::success($users,"ok",200);
    }

    public function consultAllForRol($rol):JsonResponse{

        $users=$this->user->consultAllForRol($rol);

        return ApiResponse::success($users,"ok",200);
    }

    public function paginacion(Request $request):JsonResponse{

        $filtros=[
            "rol" => $request->rol,
        ];

        $users=$this->user->paginacion($filtros);

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
        DB::beginTransaction();
        try {
            //code...
            $generatedPassword=Str::password(
                length: 15,          // Longitud (por defecto: 32)
                letters: true,       // Incluir letras (true por defecto)
                numbers: true,       // Incluir números (true por defecto)
                symbols: true,       // Incluir símbolos (true por defecto)
                spaces: false        // Incluir espacios (false por defecto)
            );

            $data=[
                "name"       => $request->admin->name,
                "last_name"  => $request->admin->last_name,
                "email"      => $request->admin->email,
                "password"   => $generatedPassword,
            ];


            $createdUser=$this->user->create($data);

            $dataEven=[
                "user"              => $createdUser,
                "passwordTextPlain" => $generatedPassword,
            ];

            CreatedAdminUserEvent::dispatch($dataEven);

            DB::commit();

            return ApiResponse::success($createdUser,"User was created successfully",200);
        } catch (\Throwable $th) {
            //throw $th;
            Log::error("Error creating admin user",[
                "error"     => $th->getMessage(),
                "line"      => $th->getLine(),
                "file"      => $th->getFile(),
            ]);
            DB::rollBack();
            return ApiResponse::error("Error creating admin user",500);
        }



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

    public function deleteUser(Request $request,$id):JsonResponse{

        $adminUser=$this->user->consultForId($id);
        if(!$adminUser){
            $mensaje="The user was not found";
            return ApiResponse::error($mensaje,404);
        }

        $this->user->delete($id);
        $verificateExistAdminUser=$this->user->consultForId($id);

        if($verificateExistAdminUser){
            $mensaje="The user admin not was deleted";
            return ApiResponse::error($mensaje,400);
        }


        return ApiResponse::success(null,"User was updated successfully",200);
    }


}
