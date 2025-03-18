<?php

namespace App\Http\Controllers;

use App\Data\CreatCompanyData;
use App\Helpers\ApiResponse;
use App\Http\Requests\CreatCompanyFormRequest;
use App\Http\Requests\UpdateCompanyFormRequest;
use App\Services\CompanyServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //

    public function __construct(
        protected CompanyServices $companyServices
    ){}

    public function consultAllCompanies(Request $request): JsonResponse{

        $consultResponse=$this->companyServices->consultCompanies();
        $mensaje="consulta completa";
        return ApiResponse::success($consultResponse,$mensaje,200);
    }

    public function consultCompanyForId(Request $request): JsonResponse{
        $id=$request->id;

        $consultResponse=$this->companyServices->consultRecordForId($id);

        if(!$consultResponse){
            $mensaje="El registro no fue encontrado";
            return ApiResponse::error($mensaje,404);
        }

        $mensaje="Consulta completado";
        return ApiResponse::success($consultResponse,$mensaje,200);
    }

    public function creatCompany(CreatCompanyFormRequest $request): JsonResponse{

        $data=[
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
        ];

        $createdCompany=$this->companyServices->creatCompany($data);

        // if(!$createdCompany){

        //     $mensaje="Error The company was not created successfully";
        //     return ApiResponse::error(null,$mensaje,500);
        // }


        $mensaje="The company was created successfully";
        return ApiResponse::success($createdCompany,$mensaje,200);
    }
    // TODO:probar el UNIQUE form Request (crear y editar) correo y telefono
    public function updateCompany(UpdateCompanyFormRequest $request, $id):JsonResponse{
        $data=[
            "id" => $request->id,
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
        ];

        if($data["id"]!=$id){
            $error=[
                "id" => "the id on body and id on the path not same"
            ];
            return ApiResponse::error("Error",400,$error);
        }

        $updatedCompany=$this->companyServices->updateCompany($data);


        $mensaje="The company was updated successfully";
        return ApiResponse::success($updatedCompany,$mensaje,200);

    }


    public function deleteCompany(Request $request):JsonResponse{


        $record=$this->companyServices->consultRecordForId($request->id);

        if(!$record){
            $mensaje="The company was found on the database";
            return ApiResponse::error($mensaje,404);
        }

        $this->companyServices->deleteCompany($record);

        $mensaje="The company was deleted successfully";
        return ApiResponse::success(null,$mensaje,200);
    }
}
