<?php

namespace Modules\Location\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryStoreRequest extends FormRequest
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
            'name' => 'required',
            'is_default' => 'required|in:0,1',
            'is_active' => 'required|in:0,1',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => __('Country is required'),
            'is_default.required' => __('Is default or not'),
            'is_default.in' => __('Is default or not'),
            'is_active.required' => __('Is active or not'),
            'is_active.in' => __('Is active or not'),
        ];
    }
}
