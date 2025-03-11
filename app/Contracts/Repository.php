<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface Repository {

    public function registrar(array $datos): Model;

    public function actualizar(array $datos): Model;

    public function eliminar(int $id): void;

    public function consultarTodo(): Collection;

    public function consultarPorId(int $id): Model | null;

}


?>
