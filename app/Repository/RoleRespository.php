<?php


namespace App\Repository;

use App\Contracts\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleRespository implements Repository {


    public function registrar(array $datos): Model
    {
        $role= new Role();
        $role->name=$datos["name"];
        $role->save();
        return $role;
    }

    public function actualizar(array $datos): Model
    {
        $role=$this->consultarPorId($datos["id"]);
        $role->name=$datos["name"];
        $role->save();
        return $role;
    }

    public function eliminar(int $id): void
    {

    }

    public function consultarPorId(int $id): Model | null
    {
        return Role::find($id);
    }

    public function consultarTodo(): Collection
    {
        return Role::all();
    }

    public function consultRoleForName($name): Model | null
    {
        return Role::where("name","=",$name)->first();
    }





}




?>
