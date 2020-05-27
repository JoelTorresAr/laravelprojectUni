<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderUpdateRequest extends FormRequest
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
            'name'           => ['required', 'string', 'max:120','unique:providers,name,'.$this->provider],
            'district_id'    => ['required','integer'],
            'address'        => ['required','string','max:120'],
            'ruc'            => ['required','string','unique:providers,ruc,'.$this->provider],
            'phone1'         => ['required','string','max:17'],
        ];
    }
}
