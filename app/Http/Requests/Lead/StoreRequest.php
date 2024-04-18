<?php

namespace App\Http\Requests\Lead;

use App\Rules\NoMultipleSpacesRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\Models\Campaign;


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
        //dd($this->all());
        // 'phone'             => ['required', 'numeric', 'min:10', Rule::unique('leads')->whereNull('deleted_at'),],
        $size = in_array($this->input('identification_type'),array_keys(config('constants.identification_type'))) ? config('constants.identification_length')[$this->input('identification_type')]: 0 ;

        $identificationRegex = in_array($this->input('identification_type'),array_keys(config('constants.identification_type'))) ? config('constants.identification_validation_regex')[$this->input('identification_type')] : '';

        $allAreaIds = Campaign::where('id',$this->input('campaign_id'))->first()->areas()->get()->pluck(['id'])->toArray();

        return [
            'name'                  => 'required|string|max:150|regex:/^[a-zA-Z]+$/', new NoMultipleSpacesRule,
            'last_name'             => 'required|string|max:150|regex:/^[a-zA-Z]+$/', new NoMultipleSpacesRule,
            'identification_type'   => 'required|numeric|in:' . implode(',', array_keys(config('constants.identification_type'))),
            // 'identification'        => 'required|string|min:16|digits:16|unique:leads,identification,NULL,id,deleted_at,NULL',
            'identification'        => 'required|string|size:'.$size.'|regex:'.$identificationRegex.'|unique:leads,identification,NULL,id,deleted_at,NULL',
            'birthdate'             => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'gender'                => 'required|numeric|in:' . implode(',', array_keys(config('constants.genders'))),
            'civil_status'          => 'required|numeric|in:' . implode(',', array_keys(config('constants.civil_status'))),
            'phone'                 => 'required|numeric|regex:/^[0-9]{7,15}$/',
            'cellphone'             => 'required|numeric|regex:/^[0-9]{7,15}$/',
            'email'                 => 'required|email|regex:/^(?!.*[\/]).+@(?!.*[\/]).+\.(?!.*[\/]).+$/i',
            'province'              => 'required|string',
            'city'                  => ['required', 'regex:/^[a-zA-Z\s]+$/', 'string', 'max:255', new NoMultipleSpacesRule],
            'address'               => 'required|string',
            'sector'                => 'required|string',
            'reference'             => 'required|string',
            'employment_status'     => 'required|numeric|in:' . implode(',', array_keys(config('constants.employment_status'))),
            'social_security'       => 'required|numeric|in:' . implode(',', array_keys(config('constants.social_securities'))),
            'company_name'          => 'required|string',
            'occupation'            => 'required|string',
            'campaign_id'           => 'required|numeric|exists:campaigns,id,deleted_at,NULL',
            'area_id'               => 'required|numeric|exists:areas,id,deleted_at,NULL|in:'.implode(',',$allAreaIds),
        ];

    }

    public function messages()
    {
        $sizeWord = in_array($this->input('identification_type'),[1,2]) ? 'digits' : 'alphanumeric characters' ;

        return [
            'birthdate.required' => 'The birth date is required.',
            'area_id.required' => 'The area is required.',
            'campaign_id.required' => 'The campaign is required.',
            'phone.regex'          => 'The :attribute must be between 7 and 15 digits.',
            'cellphone.regex'      => 'The :attribute must be between 7 and 15 digits.',
            'identification.size'   => 'The Identification Number must be exactly :size '.$sizeWord.'.',
        ];
    }

    public function attributes()
    {
        return [
            'campaign_id'=> 'campaign',
            'area_id' => 'area',
            'civil_status' => 'civil status',
            'employment_status' => 'employment status',
        ];

    }
}
