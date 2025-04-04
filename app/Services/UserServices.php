<?php

namespace App\Services;

use App\Contracts\User;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserServices implements User{


    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function consultAll(): Collection{
        return $this->userRepository->consultarTodo();
    }

    public function consultForId($id): Model | null{
        return $this->userRepository->consultarPorId($id);
    }

    // public function edit($id): Model{
    //     return $this->userRepository->consultarPorId($id);
    // }

    // public function delete($id): void{
    //     $this->userRepository->consultarPorId($id);
    // }


    public function create($data): Model{
        return $this->userRepository->registrar($data);
    }


}



?>
