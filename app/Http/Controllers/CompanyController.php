<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
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
}
