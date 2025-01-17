<?php

namespace App\Http\Requests\Campaign;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
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
        $campaignId = $this->input('campaign_id');

        return [
            'campaign_name'    => 'required|string|unique:campaigns,campaign_name,' . ($campaignId ? $campaignId : 'NULL') . ',id,deleted_at,NULL|max:150',
            'assigned_area' => 'array|required',
            'description'      => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'campaign_name.required' => __('validation.required', ['attribute' => strtolower(__('cruds.campaign.fields.campaign_name'))]),
            'campaign_name.unique' => __('validation.unique', ['attribute' => strtolower(__('cruds.campaign.fields.campaign_name'))]),
            'description.required' => __('validation.required', ['attribute' => strtolower(__('cruds.campaign.fields.description'))]),
            'campaign_name.max' => __('validation.max.string', ['attribute' => strtolower(__('cruds.campaign.fields.campaign_name')), 'max' => ':max']),
            'assigned_area.required' => __('validation.required', ['attribute' => strtolower(__('cruds.campaign.fields.assigned_area'))]),
        ];
    }
}
