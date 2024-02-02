<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        // abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'birthdate'     => 'required|date_format:Y-m-d|before:today',
            // 'username'      => 'required|string|max:255',
            'password'      => 'nullable|string|min:8|max:15|confirmed|required_with:old_password|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            // 'role'          => 'exists:roles,id',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'campaign'      => 'required',
            'campaign.*'    => 'required',

        ];
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

            'image.nullable' => __('validation.image', ['attribute' => __('cruds.user.fields.image')]),
            'image.image' => __('validation.image', ['attribute' => __('cruds.user.fields.image')]),
            'image.mimes' => __('validation.mimes', ['attribute' => __('cruds.user.fields.image'), 'values' => 'jpeg, png, jpg, gif']),
            'image.max' => __('validation.max.file', ['attribute' => __('cruds.user.fields.image'), 'max' => ':max']),

            'campaign.required' => __('validation.required', ['attribute' => __('cruds.user.fields.campaign_id')]),

            'password.nullable' => __('validation.password', ['attribute' => __('cruds.user.fields.password')]),
            'password.string' => __('validation.string', ['attribute' => __('cruds.user.fields.password')]),
            'password.min' => __('validation.min.string', ['attribute' => __('cruds.user.fields.password'), 'min' => ':min']),
            'password.max' => __('validation.max.string', ['attribute' => __('cruds.user.fields.password'), 'max' => ':max']),
            'password.regex' => __('validation.password.regex', ['attribute' => __('cruds.user.fields.password')]),


            'email.nullable' => __('validation.email', ['attribute' => __('cruds.user.fields.email')]),

        ];
    }
}
