<?php

namespace App\Repository;

use App\Contracts\RepositoryWithSoftDelete;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements RepositoryWithSoftDelete {

    function registrar(array $datos): Model{
        $usuario= new User();
        $usuario->name=$datos["name"];
        $usuario->last_name=$datos["last_name"];
        $usuario->email=$datos["email"];
        if(array_key_exists("password",$datos)){
            $usuario->password=Hash::make($datos["password"]);
        }
        $usuario->save();
        return $usuario;
    }

    function actualizar(array $datos): Model
    {
        $usuario= $this->consultarPorId($datos["id"]);
        $usuario->name=$datos["name"];
        $usuario->last_name=$datos["last_name"];
        $usuario->save();
        return $usuario;
    }

    function actualizarClave(array $datos): Model
    {
        $usuario= $this->consultarPorId($datos["id"]);
        $usuario->password=Hash::make($datos["password"]);
        $usuario->save();
        return $usuario;
    }

    function actualizarPin(array $datos): void
    {
        $usuario= $this->consultarPorId($datos["id"]);
        $usuario->pin=$datos["pin"];
        $usuario->save();
    }

    function actualizarVerificarEmail(array $datos): void
    {
        $usuario= $this->consultarPorId($datos["id"]);
        $usuario->email_verified_at=$datos["email_verified_at"];
        $usuario->save();
    }

    function consultarPorId(int $id): Model | null
    {
        return User::find($id);
    }

    function consultarTodo(): Collection
    {
        return User::all();
    }

    function consultarTodoPorRol($rol): Collection
    {
        return User::role($rol)->get();
    }

    function paginacion($filtros,$registrosPorPagina,$withoutRole): LengthAwarePaginator
    {
        $consulta=User::query();
        $consulta->with("roles");

        if(count($withoutRole)>0){
            $consulta->withoutRole($withoutRole);
        }

        if(array_key_exists("rol",$filtros)){
            if($filtros["rol"]!="null"){
               $consulta->role($filtros["rol"]);
            }
        }

        if(array_key_exists("search",$filtros)){
            if($filtros["search"]!=""){
               $consulta->where(function($query) use($filtros){
                    $query->whereRaw("CONCAT(name,' ',last_name) LIKE ?", ["%{$filtros["search"]}%"])
                    ->orWhereRaw("CONCAT(last_name,' ',name) LIKE ?", ["%{$filtros["search"]}%"])
                    ->orWhere("email","like","%".$filtros["search"]."%");
               });
            }
        }

        return $consulta->paginate($registrosPorPagina);
    }

    function eliminar(int $id): void
    {
        $usuario=$this->consultarPorId($id);
        $usuario->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return User::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return User::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model | null
    {
        User::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        User::onlyTrashed()->find($id)->forceDelete();
    }

    function consultUserForEmail($email): Model | null {
        return User::where("email","=",$email)->first();
    }

}

