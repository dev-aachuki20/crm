<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        // abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        $userId = $this->input('user_id');

        $rules = [
            'first_name'    => 'required|string|max:30',
            'last_name'     => 'required|string|max:30',
            'birthdate'     => 'required|date_format:Y-m-d|before:today',
            'role'          => 'exists:roles,id',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'campaign_id'   => 'required',
        ];

        if (isset($userId)) {
            unset($rules['password']);
        } else {
            $rules['password'] = 'required|string|min:8|max:12';
            $rules['email']    = 'required|unique:users,email';
            $rules['username'] = 'required|string|unique:users,username';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => __('validation.required', ['attribute' => __('cruds.user.fields.first_name')]),
            'first_name.string' => __('validation.string', ['attribute' => __('cruds.user.fields.first_name')]),
            'first_name.max' => __('validation.max.string', ['attribute' => __('cruds.user.fields.first_name'), 'max' => ':max']),

            'last_name.required' => __('validation.required', ['attribute' => __('cruds.user.fields.last_name')]),
            'last_name.string' => __('validation.string', ['attribute' => __('cruds.user.fields.last_name')]),
            'last_name.max' => __('validation.max.string', ['attribute' => __('cruds.user.fields.last_name'), 'max' => ':max']),

            'birthdate.required' => __('validation.required', ['attribute' => __('cruds.user.fields.birthdate')]),
            'birthdate.before' => __('validation.before', ['attribute' => __('cruds.user.fields.birthdate')]),

            'role.exists' => __('validation.exists', ['attribute' => __('cruds.user.fields.role')]),

            'image.nullable' => __('validation.image', ['attribute' => __('cruds.user.fields.image')]),
            'image.image' => __('validation.image', ['attribute' => __('cruds.user.fields.image')]),
            'image.mimes' => __('validation.mimes', ['attribute' => __('cruds.user.fields.image'), 'values' => 'jpeg, png, jpg, gif']),
            'image.max' => __('validation.max.file', ['attribute' => __('cruds.user.fields.image'), 'max' => ':max']),

            'campaign_id.required' => __('validation.required', ['attribute' => __('cruds.user.fields.campaign_id')]),

            'password.required' => __('validation.required', ['attribute' => __('cruds.user.fields.password')]),
            'password.string' => __('validation.string', ['attribute' => __('cruds.user.fields.password')]),
            'password.min' => __('validation.min.string', ['attribute' => __('cruds.user.fields.password'), 'min' => ':min']),
            'password.max' => __('validation.max.string', ['attribute' => __('cruds.user.fields.password'), 'max' => ':max']),


            'email.required' => __('validation.required', ['attribute' => __('cruds.user.fields.email')]),
            'email.unique' => __('validation.unique', ['attribute' => __('cruds.user.fields.email')]),


            'username.required' => __('validation.required', ['attribute' => __('cruds.user.fields.user_name')]),
            'username.string' => __('validation.string', ['attribute' => __('cruds.user.fields.user_name')]),
            'username.unique' => __('validation.unique', ['attribute' => __('cruds.user.fields.user_name')]),

        ];
    }
}
