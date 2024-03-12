<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        abort_if((Gate::denies('leads_edit')), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:150|regex:/^[a-zA-Z]+$/',
            'last_name' => 'required|string|max:150|regex:/^[a-zA-Z]+$/',
            'identification' => 'required|numeric|min:16|digits:16|unique:leads,identification,'.$this->lead->id,
            'birthdate' => 'required|date',
            'gender'=> 'required|numeric',
            'civil_status' => 'required|numeric',
            'phone' => 'required|numeric|min:10',
            'cellphone' => 'required|numeric|min:12',
            'email' => 'required|email',
            'province' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'sector' => 'required|string',
            'reference' => 'required|string',
            'employment_status' => 'required|numeric',
            'social_security' => 'required|numeric',
            'company_name' => 'required|string',
            'occupation' => 'required|string',
            'campaign_id' => 'required|numeric|exists:campaigns,id',
            'area_id' => 'required|numeric|exists:areas,id',
        ];
    }

    public function messages()
    {
        return [
            'assign_to_id.required' => 'The Assign To is required.',
            'area_id.required' => 'The Area is required.',
            'campaign_id.required' => 'The Campaign is required.',
        ];
    }
}
