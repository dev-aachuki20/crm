<?php

namespace App\Http\Requests\Lead;

use App\Rules\NoMultipleSpacesRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

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
        $lead = $this->lead;

        return [
            'name'              => 'required|string|max:150|regex:/^[a-zA-Z]+$/',new NoMultipleSpacesRule,
            'last_name'         => 'required|string|max:150|regex:/^[a-zA-Z]+$/',new NoMultipleSpacesRule,
            // 'identification'    => 'required|numeric|min:16|digits:16|unique:leads,identification,'.$lead.',id,deleted_at,NULL',
            'identification'    => ['required','numeric','min:16','digits:16',Rule::unique('leads')->ignore($lead)->whereNull('deleted_at'),],
            'birthdate'         => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'gender'            => 'required|numeric',
            'civil_status'      => 'required|numeric',
            'phone'             => 'required|numeric|min:10|unique:leads,phone,'.$lead.',id,deleted_at,NULL',
            'cellphone'         => 'required|numeric|min:12|unique:leads,cellphone,'.$lead.',id,deleted_at,NULL',
            'email'             => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:leads,email,'.$lead.',id,deleted_at,NULL',
            'province'          => 'required|string',
            'city'              => ['required','regex:/^[a-zA-Z\s]+$/','string','max:255',new NoMultipleSpacesRule],
            'address'           => 'required|string',
            'sector'            => 'required|string',
            'reference'         => 'required|string',
            'employment_status' => 'required|numeric',
            'social_security'   => 'required|numeric',
            'company_name'      => 'required|string',
            'occupation'        => 'required|string',
            'campaign_id'       => 'required|numeric|exists:campaigns,id',
            'area_id'           => 'required|numeric|exists:areas,id',
        ];
    }

    public function messages()
    {
        return [
            'gender.required' => 'The Sex is required.',
            'birthdate.required' => 'The Birth Date is required.',
            'area_id.required' => 'The Area is required.',
            'campaign_id.required' => 'The Campaign is required.',
        ];
    }
}
