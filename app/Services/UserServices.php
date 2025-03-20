<?php

namespace App\Services;

use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserServices {


    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function consultAll(): Collection{
        return $this->userRepository->consultarTodo();
    }

    public function consultUserForId($id): Model | null{
        return $this->userRepository->consultarPorId($id);
    }


    public function createUser($data){
        return $this->userRepository->registrar($data);
    }


}



?>
