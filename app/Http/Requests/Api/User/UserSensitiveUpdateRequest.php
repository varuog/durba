<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class UserSensitiveUpdateRequest extends FormRequest
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
     * @todo otp module confiurable
     * @return array
     */
    public function rules()
    {
        $type = $this->route('type');
        if($type == 'email') {
           $idRule = '|email';
        } else if($type == 'mobile') {
            $idRule = '|string';
        }
        return [
            'field' => "required|{$idRule}",
            'otp' => 'required|string',
        ];
        
    }
}
