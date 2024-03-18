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
            'phone'             => 'required|numeric|regex:/^[0-9]{7,15}$/',
            'cellphone'         => 'required|numeric|regex:/^[0-9]{7,15}$/',
            'email'             => 'required|email|regex:/^(?!.*[\/]).+@(?!.*[\/]).+\.(?!.*[\/]).+$/i',
            'province'          => 'required|string',
            'city'              => ['required','regex:/^[a-zA-Z\s]+$/','string','max:255',new NoMultipleSpacesRule],
            'address'           => 'required|string',
            'sector'            => 'required|string',
            'reference'         => 'required|string',
            'employment_status' => 'required|numeric',
            'social_security'   => 'required|numeric',
            'company_name'      => 'required|string',
            'occupation'        => 'required|string',
            'campaign_id'       => 'required|numeric|exists:campaigns,id,deleted_at,NULL',
            'area_id'           => 'required|numeric|exists:areas,id,deleted_at,NULL',
        ];
    }

    public function messages()
    {
        return [
            'gender.required' => 'The sex is required.',
            'birthdate.required' => 'The birth date is required.',
            'area_id.required' => 'The area is required.',
            'campaign_id.required' => 'The campaign is required.',
            'phone.regex'          => 'The :attribute must be between 7 and 15 digits.',
            'cellphone.regex'      => 'The :attribute must be between 7 and 15 digits.',


        ];
    }

    public function attribute()
    { 
        return [
            'campaign_id'=> 'campaign',
            'area_id' => 'area',
            'civil_status' => 'civil status',
            'employment_status' => 'employment status',
        ];

    }
}
