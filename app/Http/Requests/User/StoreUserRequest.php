<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $this->offsetUnset('roleId');
        return [
            'name'                    => ['required'],
            'active'                  => ['boolean'],
            'avatar'                  => ['nullable'],
            'roleId'                  => ['int'],
            'email'                   => ['required', 'unique:users'],
            'password'                => ['required', 'min:6'],
            'cellphone'               => ['nullable'],
        ];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        //This will always return JSON object error messages
        return new JsonResponse($errors, 422);
    }
}
