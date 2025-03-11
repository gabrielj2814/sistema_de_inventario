<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryWithSoftDelete extends Repository {

    public function recuperarDeLaPapeleraPorId(int $id): Model | null;

    public function eliminarDeLaPapelera(int $id): void;

    public function consultarTodoDeLaPapelera(): Collection;

    public function consultarPorIdEnLaPapelera(int $id): Model | null;

}


?>
