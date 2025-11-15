<?php

namespace Modules\Location\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryDetailUpdateRequest extends FormRequest
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
            'sort_name' => 'string|max:5|nullable',
            'phone_code' => 'string|max:7|nullable',
            'currency' => 'string|max:60|nullable',
            'code' => 'string|max:7|nullable',
            'symbol' => 'string|max:7|nullable',
            'thousand_separator' => 'string|max:2|nullable',
            'decimal_separator' => 'string|max:2|nullable',
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
            'sort_name.string' => __('Sort name must be string'),
            'sort_name.max' => __('Sort name max length is 5'),
            'phone_code.string' => __('Phone code must be string'),
            'phone_code.max' => __('Phone code max length is 7'),
            'currency.string' => __('Currency must be string'),
            'currency.max' => __('Currency max length is 60'),
            'code.string' => __('Code must be string'),
            'code.max' => __('Code max length is 7'),
            'symbol.string' => __('Symbol must be string'),
            'symbol.max' => __('Symbol max length is 7'),
            'thousand_separator.string' => __('Thousand separator must be string'),
            'thousand_separator.max' => __('Thousand separator max length is 2'),
            'decimal_separator.string' => __('Decimal separator must be string'),
            'decimal_separator.max' => __('Decimal separator max length is 2'),
        ];
    }
}
