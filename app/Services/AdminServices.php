<?php
// AdminServices

namespace App\Services;

use App\Contracts\User;
use App\Repository\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminServices implements User {


    public function __construct(
        protected UserRepository $userRepository
    ){}

    public function consultAll(): Collection{
        return $this->userRepository->consultarTodo();
    }

    public function consultAllForRol($rol): Collection{
        return $this->userRepository->consultarTodoPorRol($rol);
    }

    public function paginacion($filtros=[]): LengthAwarePaginator{
        return $this->userRepository->paginacion($filtros);
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
        $user->assignRole("Web-Team-default-Member");
        return $user;
    }


}


?>
