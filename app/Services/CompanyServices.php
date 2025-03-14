<?php

namespace App\Services;

use App\Repository\CompanyRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CompanyServices {

    function __construct(
        protected CompanyRepository $companyRepository
    ){}


    public function consultCompanies(): Collection{
        return $this->companyRepository->consultarTodo();
    }

    public function consultRecordForId($id): Model | null{
        return $this->companyRepository->consultarPorId($id);
    }



}



?>
