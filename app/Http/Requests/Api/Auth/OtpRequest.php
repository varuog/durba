<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class OtpRequest extends FormRequest
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
     * @todo conditionaly add laravel way [improvment]
     * @return array
     */
    public function rules()
    {
        $rule = [
            'type' => 'required|string|in:email,mobile'
        ];
        if($this->type == 'email') {
            array_merge($rule, [
                'identifier' => 'required|string|email',
            ]);
        } else if($this->type == 'mobile'){
            array_merge($rule, [
                'identifier' => 'required|string', //@todo mobile validation
            ]);
        } else {
            array_merge($rule, [
                'identifier' => 'required|string',
            ]);
        }
        //dd($rule);  
        return $rule;
    }
}
