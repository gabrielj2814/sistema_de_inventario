<?php

namespace App\Http\Requests;

use App\Data\CreatCompanyData;
use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreatCompanyFormRequest extends FormRequest
{

    public CreatCompanyData $company;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            "name"    =>    "required|string|max:255",
            "email"   =>    "required|string|max:255|email:rfc,dns",
            "phone"   =>    "required|string|max:15|min:11",
            "address" =>    "required|string|max:255",

        ];
    }

    public function menssages(){
        return [
            "name.required" => "the field is required",
            "name.string"   => "the field is type string",
            "name.max"      => "the max of field is 255 characters",
            "email.required" => "the field is required",
            "email.string"   => "the field is type string",
            "email.max"      => "the max of field is 255 characters",
            "email.email"      => "the format of email is invalid",
            "phone.required" => "the field is required",
            "phone.string"   => "the field is type string",
            "phone.max"      => "the max of field is 255 characters",
            "phone.min"      => "the min of field is 11 characters",
            "address.required" => "the field is required",
            "address.string"   => "the field is type string",
            "address.max"      => "the max of field is 255 characters",
        ];
    }

    protected function failedValidation(Validator $validator):JsonResponse
    {
        $errors=$validator->errors();
        $response=ApiResponse::error("Error",422,$errors);
        throw new HttpResponseException($response);
    }

    protected function passedValidation()
    {
        $this->company=CreatCompanyData::from([
            "name"    =>    $this->name,
            "email"   =>    $this->email,
            "phone"   =>    $this->phone,
            "address" =>    $this->address,
        ]);
    }
}
