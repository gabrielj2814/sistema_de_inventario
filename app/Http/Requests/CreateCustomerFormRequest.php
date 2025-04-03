<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use CreateCustomerData;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreateCustomerFormRequest extends FormRequest
{

    public CreateCustomerData $customer;
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
            "name"                 =>    "required|string|max:255",
            "last_name"            =>    "required|string|max:255",
            "email"                =>    "required|string|unique:App\Models\User,email|max:255|email:rfc,dns",
            "password"             =>    "required|string|min:8|max:255",
            "name_company"         =>    "required|string|unique:App\Models\Company,name|max:255",
            "phone_company"        =>    "required|string|unique:App\Models\Company,phone|min:15|max:15",
            "email_company"        =>    "required|string|unique:App\Models\Company,email|max:255|email:rfc,dns",
        ];
    }

    public function menssages(){
        return [
            "name.required"             => "the field is required",
            "name.string"               => "the field is type string",
            "name.max"                  => "the max characters of field is 255 characters",
            "password.required"         => "the field is required",
            "password.string"           => "the field is type string",
            "password.max"              => "the max characters of field is 255 characters",
            "password.min"              => "the min characters of field is 8 characters",
            "last_name.required"        => "the field is required",
            "last_name.string"          => "the field is type string",
            "last_name.max"             => "the max characters of field is 255 characters",
            "email.required"            => "the field is required",
            "email.string"              => "the field is type string",
            "email.max"                 => "the max characters of field is 255 characters",
            "email.email"               => "the format of email is invalid",
            "email.unique"              => "the email is in use",
            "name_company.required"     => "the field is required",
            "name_company.string"       => "the field is type string",
            "name_company.max"          => "the max characters of field is 255 characters",
            "name_company.unique"       => "the name company is in use",
            "phone_company.required"    => "the field is required",
            "phone_company.string"      => "the field is type string",
            "phone_company.max"         => "the max characters of field is 15 characters",
            "phone_company.min"         => "the min characters of field is 15 characters",
            "phone_company.unique"      => "the name company is in use",
            "email_company.required"    => "the field is required",
            "email_company.string"      => "the field is type string",
            "email_company.max"         => "the max characters of field is 255 characters",
            "email_company.email"       => "the format of email is invalid",
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
        $this->customer=CreateCustomerData::from([
            "name"                =>    $this->name,
            "last_name"           =>    $this->last_name,
            "email"               =>    $this->email,
            "password"            =>    $this->password,
            "name_company"        =>    $this->name_company,
            "phone_company"       =>    $this->phone_company,
            "email_company"       =>    $this->email_company,
        ]);
    }
}
