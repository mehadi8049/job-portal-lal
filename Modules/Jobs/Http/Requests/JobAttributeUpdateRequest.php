<?php

namespace Modules\Jobs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobAttributeUpdateRequest extends FormRequest
{
    protected $model_class;

    protected $translates;

    public function __construct()
    {
        $this->model_class = config('oneresumecv.attributes.model_class');
        $this->translates = config('oneresumecv.attributes.translates');
    }

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
        $id = $this->route('id');

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
            'name.required' => $this->translates['name.required'],
            'is_default.required' => __('Is default or not'),
            'is_default.in' => __('Is default or not'),
            'is_active.required' => __('Is active or not'),
            'is_active.in' => __('Is active or not'),
        ];
    }
}
