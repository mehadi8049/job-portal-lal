<?php

namespace Modules\Jobs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyJobRequest extends FormRequest
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
            'job_id' => 'required',
            'company_id' => 'nullable',
            'fullname' => 'required',
            'email' => 'required|email',
            'description' => 'nullable|max:255',
            'resume_link' => 'nullable|url',
            'resume_pdf' => 'mimes:pdf|max:2048|nullable',
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
            'validation.mimes' => __('Please choose PDF file'),
            'validation.max.string' => 'Maximum description',

        ];
    }
}
