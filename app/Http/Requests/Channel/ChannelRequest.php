<?php

namespace App\Http\Requests\Channel;

use Illuminate\Foundation\Http\FormRequest;

class ChannelRequest extends FormRequest
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
        $channelId = $this->input('channel_id');

        return [
            'channel_name' => 'required|unique:channels,channel_name,' . ($channelId ? $channelId : 'NULL') . ',id,deleted_at,NULL|max:150',
            'description' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'channel_name.required' => __('validation.required', ['attribute' => __('cruds.area.fields.name')]),
            'channel_name.unique' => __('validation.unique', ['attribute' => __('cruds.area.fields.name')]),
            'description.required' => __('validation.required', ['attribute' => __('cruds.area.fields.description')]),
            'channel_name.max' => __('validation.max.string', ['attribute' => __('cruds.area.fields.name'), 'max' => ':max']),
        ];
    }
}
