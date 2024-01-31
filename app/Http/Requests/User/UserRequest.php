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
            'birthdate'     => 'required|date_format:Y-m-d',
            'role'          => 'exists:roles,id',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'campaign_id'   => 'nullable',
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
            // 'first_name.required' => __('validation.user.required'),
            // 'last_name.required' => __('validation.user.required'),
            // 'email.required' => __('validation.user.required'),
            // 'birthdate.required' => __('validation.user.required'),
            // 'username.required' => __('validation.user.required'),
            // 'password.required' => __('validation.user.required'),


            'first_name.required' => __('validation.required', ['attribute' => __('cruds.user.fields.first_name')]),
            'first_name.string' => __('validation.string', ['attribute' => __('cruds.user.fields.first_name')]),
            'first_name.max' => __('validation.max.string', ['attribute' => __('cruds.user.fields.first_name'), 'max' => ':max']),

            'last_name.required' => __('validation.required', ['attribute' => __('cruds.user.fields.last_name')]),
            'last_name.string' => __('validation.string', ['attribute' => __('cruds.user.fields.last_name')]),
            'last_name.max' => __('validation.max.string', ['attribute' => __('cruds.user.fields.last_name'), 'max' => ':max']),

            'birthdate.required' => __('validation.required', ['attribute' => __('cruds.user.fields.birthdate')]),
            // today date , date format 

            // 'role'          => 'exists:roles,id',

            'role.exists' => __('validation.exists', ['attribute' => __('cruds.user.fields.role')]),






        ];
    }
}
