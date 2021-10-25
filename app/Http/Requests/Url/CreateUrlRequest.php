<?php

namespace App\Http\Requests\Url;

use Illuminate\Foundation\Http\FormRequest;

class CreateUrlRequest extends FormRequest
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
            'url'       => 'unique:url|required|min:5|regex:^([\- \w]+\.)+\w{2,3}(\/ [%\-\w]+(\.\w{2,})?)*$^',
            'descricao' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'url.required'  => 'O campo URL é obrigatório.',
            'email.min'     => 'URL inválida.',
            'email.regex'   => 'URL inválida.',
        ];
    }
}
