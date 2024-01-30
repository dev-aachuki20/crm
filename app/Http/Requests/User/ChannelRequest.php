<?php

namespace App\Http\Requests\User;

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
            'channel_name' => 'required|unique:channels,channel_name,' . $channelId . '|max:255',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'channel_name.required' => __('validation.channel.required'),
            'description.required' => __('validation.channel.required'),
        ];
    }
}
