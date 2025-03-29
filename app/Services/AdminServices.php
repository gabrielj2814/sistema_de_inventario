<?php
// AdminServices

namespace App\Services;

use App\Contracts\User;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AdminServices implements User {


    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function consultAll(): Collection{
        return $this->userRepository->consultarTodo();
    }

    public function consultForId($id): Model | null{
        return $this->userRepository->consultarPorId($id);
    }

    public function edit($data): Model{
        return $this->userRepository->actualizar($data);
    }

    public function delete($id): void{
        $this->userRepository->eliminar($id);
    }

    public function create($data): Model{
        $user=$this->userRepository->registrar($data);
        $user->assignRole("Team-Admin-Member");
        return $user;
    }


}


?>
