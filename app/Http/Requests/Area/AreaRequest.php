<?php

namespace App\Http\Requests\Area;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $areaId = $this->input('area_id');

        return [
            'area_name'     => 'required|unique:areas,area_name,' . ($areaId ? $areaId : 'NULL') . ',id,deleted_at,NULL|max:150',
            'description'   => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'area_name.required'    => __('validation.required', ['attribute' => __('cruds.area.fields.name')]),
            'area_name.unique'      => __('validation.unique', ['attribute' => __('cruds.area.fields.name')]),
            'description.required'  => __('validation.required', ['attribute' => __('cruds.area.fields.description')]),
            'area_name.max'         => __('validation.max.string', ['attribute' => __('cruds.area.fields.name'), 'max' => ':max']),
        ];
    }
}
