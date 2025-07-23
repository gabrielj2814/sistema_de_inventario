<?php


namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface User {

    public function create(array $datos): Model;

    public function edit(array $datos): Model;

    public function delete(int $id): void;

    public function consultAll(): Collection;

    public function paginacion(): LengthAwarePaginator;

    public function consultForId(int $id): Model | null;

    public function consultAllForRol(String $rol): Collection;


}


?>
