<?php

namespace App\Services;

use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class LoginServices {


    function __construct(
        protected UserRepository $userRepository
    ){}


    public function validateCredentials($email,$password): Bool{
        $user= $this->userRepository->consultUserForEmail($email);
        if(!$user){
            return false;
        }

        if(!Hash::check($password,$user->password)){
            return false;
        }

        return true;
    }

    public function findUserForEmail($email): Model | null{
        return $this->userRepository->consultUserForEmail($email);

    }






}



?>
