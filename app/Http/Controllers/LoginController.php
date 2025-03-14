<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Services\LoginServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    //

    function __construct(
        protected LoginServices $loginServices
    ){}


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

        $token=$user->createToken($user->id, ['*'], now()->addWeek())->plainTextToken;

        $mensaje="Ok";
        $data=[
            "token" => $token,
        ];

        return ApiResponse::success($data,$mensaje);
    }

    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();

        $mensaje="It has been remove the session";

        return ApiResponse::success(null,$mensaje);
    }

    public function removerAllSession(Request $request){

        $request->user()->tokens()->delete();

        $mensaje="It has been remove all session";

        return ApiResponse::success(null,$mensaje);
    }


}
