<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\CompanyServices;
use App\Services\LoginServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class LoginController extends Controller
{
    //

    function __construct(
        protected LoginServices $loginServices,
        protected CompanyServices $companyServices
    ){}


    public function view(){

        $rutas=[
            "dashboard" => route("dashboard"),
        ];
        return Inertia::render("LoginAdmin",[
            "rutas" => $rutas
        ]);
    }

    public function viewLoginCompany($company_id){

        $company=$this->companyServices->consultRecordForId($company_id);

        if(!$company){
            return "the company not exist";
        }

        $rutas=[
            "dashboard" => route("dashboard"),
        ];

        return Inertia::render("LoginCompany",[
            "dataCompany" =>$company,
            "rutas" =>$rutas,
        ]);
    }


    public function login(Request $request):JsonResponse{


        $email=$request->email;
        $password=$request->password;

        $user=$this->loginServices->findUserForEmail($email);
        if(!$user){
            Log::info("the user attempted login with next email => {".$email."}");
            $mensaje="Correo invalido";
            return ApiResponse::error($mensaje,400);
        }

        $validatedCredentials=$this->loginServices->validateCredentials($email,$password);
        if(!$validatedCredentials){
            Log::info("Credenciales no validads por el usuario => {".$email."}");
            $mensaje="Credenciales incorrecta";
            return ApiResponse::error($mensaje,400);
        }
        Log::info("Login Ok => {".$email."}");

        $mensaje="Ok";
        $data=[];

        if ($request->is('api/*')) {
            $token=$user->createToken($user->id, ['*'], now()->addWeek())->plainTextToken;
            $data=[
                "token" => $token,
            ];
        }
        else{
            Auth::login($user);
        }

        return ApiResponse::success($data,$mensaje);
    }

    public function logout(Request $request){

        $user= $request->user();
        if ($request->is('api/*')) {
            $user->currentAccessToken()->delete();
        }
        else{
            Auth::logout($user);
        }

        $mensaje="It has been remove the session";

        return ApiResponse::success(null,$mensaje);
    }

    public function removerAllSession(Request $request){

        $request->user()->tokens()->delete();

        $user= $request->user();
        if ($request->is('api/*')) {
            $user->tokens()->delete();
            DB::table('sessions')
            ->where('user_id', $user->id)
            ->delete();
        }
        else{
            $user->tokens()->delete();
            DB::table('sessions')
            ->where('user_id', $user->id)
            ->delete();
            Auth::logout($user);
        }

        $mensaje="It has been remove all session";

        return ApiResponse::success(null,$mensaje);
    }


}
