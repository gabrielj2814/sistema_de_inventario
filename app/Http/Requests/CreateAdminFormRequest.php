<?php

namespace App\Http\Requests;

use App\Data\CreateAdminData;
use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreateAdminFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public CreateAdminData $admin;

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
            "name"         =>    "required|string|max:255",
            "last_name"    =>    "required|string|max:255",
            "email"        =>    "required|string|unique:App\Models\User,email|max:255|email:rfc,dns",
        ];
    }

    public function menssages(){
        return [
            "name.required" => "the field is required",
            "name.string"   => "the field is type string",
            "name.max"      => "the max of field is 255 characters",
            "last_name.required" => "the field is required",
            "last_name.string"   => "the field is type string",
            "last_name.max"      => "the max of field is 255 characters",
            "email.required" => "the field is required",
            "email.string"   => "the field is type string",
            "email.max"      => "the max of field is 255 characters",
            "email.email"      => "the format of email is invalid",
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
        $this->admin=CreateAdminData::from([
            "name"         =>    $this->name,
            "last_name"    =>    $this->last_name,
            "email"        =>    $this->email,
        ]);
    }
}
