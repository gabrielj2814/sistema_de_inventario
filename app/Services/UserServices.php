<?php

namespace App\Services;

use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserServices {


    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function consultAll(): Collection{
        return $this->userRepository->consultarTodo();
    }

    public function createUser($data){
        return $this->userRepository->registrar($data);
    }


}



?>
