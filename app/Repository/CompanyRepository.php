<?php


namespace App\Repository;

use App\Contracts\RepositoryWithSoftDelete;
use App\Models\Company;
use App\Models\CustomerHasCompany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CompanyRepository implements RepositoryWithSoftDelete {

    function registrar(array $datos): Model{
        $company= new Company();
        $company->name=$datos["name"];
        $company->email=$datos["email"];
        $company->phone=$datos["phone"];
        $company->address=$datos["address"];
        $company->save();
        return $company;
    }

    function actualizar(array $datos): Model
    {
        $company= $this->consultarPorId($datos["id"]);
        $company->name=$datos["name"];
        $company->email=$datos["email"];
        $company->phone=$datos["phone"];
        $company->address=$datos["address"];
        $company->save();
        return $company;
    }

    function consultarPorId(int $id): Model | null
    {
        return Company::find($id);
    }

    function consultarTodo(): Collection
    {
        return Company::all();
    }

    function eliminar(int $id): void
    {
        $company=$this->consultarPorId($id);
        $company->delete();
    }

    function consultarTodoDeLaPapelera(): Collection
    {
        return Company::onlyTrashed()->get();
    }

    function consultarPorIdEnLaPapelera($id): Model | null
    {
        return Company::onlyTrashed()->find($id);
    }

    function recuperarDeLaPapeleraPorId(int $id): Model | null
    {
        Company::onlyTrashed()->find($id)->restore();
        return $this->consultarPorId($id);
    }

    function eliminarDeLaPapelera(int $id): void
    {
        Company::onlyTrashed()->find($id)->forceDelete();
    }

    function consultCompanyForEmail($email): Model | null {
        return Company::where("email","=",$email)->first();
    }

    function assignCompany($user_id,$company_id): Model | null {
        $company= $this->consultarPorId($company_id);

        $assigCustomerCompany=new CustomerHasCompany();
        $assigCustomerCompany->user_id=$user_id;
        $assigCustomerCompany->companies_id=$company->id;
        $assigCustomerCompany->save();

        return $assigCustomerCompany;
    }

}



?>
