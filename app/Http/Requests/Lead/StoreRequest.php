<?php

namespace App\Http\Requests\Lead;

use App\Rules\NoMultipleSpacesRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        abort_if((Gate::denies('leads_create')), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        // 'phone'             => ['required', 'numeric', 'min:10', Rule::unique('leads')->whereNull('deleted_at'),],

        return [
            'name'              => 'required|string|max:150|regex:/^[a-zA-Z]+$/', new NoMultipleSpacesRule,
            'last_name'         => 'required|string|max:150|regex:/^[a-zA-Z]+$/', new NoMultipleSpacesRule,
            'identification'    => 'required|numeric|min:16|digits:16|unique:leads,identification,NULL,id,deleted_at,NULL',
            'birthdate'         => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'gender'            => 'required|numeric|in:' . implode(',', array_keys(config('constants.genders'))),
            'civil_status'      => 'required|numeric|in:' . implode(',', array_keys(config('constants.civil_status'))),
            'phone'             => 'required', 'numeric', 'min:10',
            'cellphone'         => 'required', 'numeric', 'min:12',
            'email'             => 'required', 'email', 'regex:/(.+)@(.+)\.(.+)/i',
            'province'          => 'required|string',
            'city'              => ['required', 'regex:/^[a-zA-Z\s]+$/', 'string', 'max:255', new NoMultipleSpacesRule],
            'address'           => 'required|string',
            'sector'            => 'required|string',
            'reference'         => 'required|string',
            'employment_status' => 'required|numeric|in:' . implode(',', array_keys(config('constants.employment_status'))),
            'social_security'   => 'required|numeric|in:' . implode(',', array_keys(config('constants.social_securities'))),
            'company_name'      => 'required|string',
            'occupation'        => 'required|string',
            'campaign_id'       => 'required|numeric|exists:campaigns,id',
            'area_id'           => 'required|numeric|exists:areas,id',
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'gender.required' => 'The Sex is required.',
    //         'birthdate.required' => 'The Birth Date is required.',
    //         'gender.required' => 'The Sex is required.',
    //         'area_id.required' => 'The Area is required.',
    //         'campaign_id.required' => 'The Campaign is required.',
    //     ];
    // }
}
