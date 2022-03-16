<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
        return [
            'email' => ['sometimes' , 'string', Rule::unique('users', 'email')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            'password' => ['required' ,'string', 'confirmed', Password::min(8)->mixedCase()],
            'mobile' => ['required' , 'string', Rule::unique('users', 'mobile')->where(function ($query) {
                    return $query->whereNull('deleted_at');
            })],
            'first_name' => 'required|string',
            'middle_name' => 'sometimes|string|nullable',
            'last_name' => 'required|string',
            'otp' => 'required|string',
            "social_provider" => "sometimes|string|in:" . implode(',', config('durba.user.social-providers')),
            "social_token" => 'sometimes|string|required_with:social_provider'
        ];
    }
}
