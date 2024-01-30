<?php

namespace App\Http\Requests\User;

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
        return [
            'campaign_name'    => 'required|string|max:255',
            'assigned_channel' => 'required',
            'created_by'       => 'required',
            'description'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'campaign_name.required' => __('validation.channel.required'),
            'assigned_channel.required' => __('validation.channel.required'),
            'created_by.required' => __('validation.channel.required'),
            // 'tagList.required' => __('validation.channel.required'),
            'description.required' => __('validation.channel.required'),
        ];
    }
}
