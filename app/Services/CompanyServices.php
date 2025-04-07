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

    public function creatCompany($data){
        return $this->companyRepository->registrar($data);
    }

    public function assignCompany($user_id,$company_id): Model | null{
        return $this->companyRepository->assignCompany($user_id,$company_id);
    }

    public function updateCompany($data): Model{
        return $this->companyRepository->actualizar($data);
    }

    public function deleteCompany(Model $record): void{
        $this->companyRepository->eliminar($record->id);
    }






}



?>
