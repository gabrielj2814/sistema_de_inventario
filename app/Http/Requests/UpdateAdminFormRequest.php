<?php

namespace App\Http\Requests;

use App\Data\UpdateAdminData;
use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateAdminFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

     public UpdateAdminData $admin;


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
            "id"           =>    "required|exists:App\Models\User,id",
            "name"         =>    "required|string|max:255",
            "last_name"    =>    "required|string|max:255",
        ];
    }

    public function messages(){
        return [
            "id.required"  => "the field is required",
            "id.exists"    => "the user was not found on the database",
            "name.required" => "the field is required",
            "name.string"   => "the field is type string",
            "name.max"      => "the max of field is 255 characters",
            "last_name.required" => "the field is required",
            "last_name.string"   => "the field is type string",
            "last_name.max"      => "the max of field is 255 characters",
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
        $this->admin=UpdateAdminData::from([
            "id"         =>    $this->id,
            "name"         =>    $this->name,
            "last_name"    =>    $this->last_name,
        ]);
    }
}
