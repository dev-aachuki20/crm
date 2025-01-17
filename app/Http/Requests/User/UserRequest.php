<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoMultipleSpacesRule;

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
            'first_name'    => ['required','regex:/^[a-zA-Z\s]+$/','string','max:255',new NoMultipleSpacesRule],
            'last_name'     => ['required','regex:/^[a-zA-Z\s]+$/','string','max:255',new NoMultipleSpacesRule],
            'birthdate'     => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'role'          => 'required|exists:roles,id',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'campaign'   => 'array|required',
        ];

        if (isset($userId)) {
            unset($rules['password']);
        } else {

            $rules['password'] = 'required|string|min:8|max:15|regex:/^(?!.*\s)(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/';

            // $rules['email']    = 'required|ends_with:gmail.com, mail.com|unique:users,email';
            $rules['email']    = 'required|email|unique:users,email,NULL,id,deleted_at,NULL|regex:/(.+)@(.+)\.(.+)/i';
            $rules['username'] = 'required|alpha_num|string|regex:/^\S*$/|unique:users,username,NULL,id,deleted_at,NULL';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => __('validation.required', ['attribute' => strtolower(__('cruds.user.fields.first_name'))]),
            'first_name.regex' => __('validation.regex', ['attribute' => strtolower(__('cruds.user.fields.first_name'))]),
            'first_name.string' => __('validation.string', ['attribute' => strtolower(__('cruds.user.fields.first_name'))]),
            'first_name.max' => __('validation.max.string', ['attribute' => strtolower(__('cruds.user.fields.first_name')), 'max' => ':max']),

            'last_name.required' => __('validation.required', ['attribute' => strtolower(__('cruds.user.fields.last_name'))]),
            'last_name.regex' => __('validation.regex', ['attribute' => strtolower(__('cruds.user.fields.last_name'))]),
            'last_name.string' => __('validation.string', ['attribute' => strtolower(__('cruds.user.fields.last_name'))]),
            'last_name.max' => __('validation.max.string', ['attribute' => strtolower(__('cruds.user.fields.last_name')), 'max' => ':max']),

            'birthdate.required' => __('validation.required', ['attribute' => strtolower(__('cruds.user.fields.birthdate'))]),
            'birthdate.date' => __('validation.date', ['attribute' => strtolower(__('cruds.user.fields.birthdate'))]),
            'birthdate.before_or_equal' => __('validation.before', ['attribute' => strtolower(__('cruds.user.fields.birthdate'))]),

            'role.exists' => __('validation.exists', ['attribute' => strtolower(__('cruds.user.fields.role'))]),

            'image.nullable' => __('validation.image', ['attribute' => strtolower(__('cruds.user.fields.image'))]),
            'image.image' => __('validation.image', ['attribute' => strtolower(__('cruds.user.fields.image'))]),
            'image.mimes' => __('validation.mimes', ['attribute' => strtolower(__('cruds.user.fields.image')), 'values' => 'jpeg, png, jpg, gif']),
            'image.max' => __('validation.max.file', ['attribute' => strtolower(__('cruds.user.fields.image')), 'max' => ':max']),

            'campaign_id.required' => __('validation.required', ['attribute' => strtolower(__('cruds.user.fields.campaign_id'))]),

            'password.required' => __('validation.required', ['attribute' => strtolower(__('cruds.user.fields.password'))]),
            'password.string' => __('validation.string', ['attribute' => strtolower(__('cruds.user.fields.password'))]),
            'password.min' => __('validation.min.string', ['attribute' => strtolower(__('cruds.user.fields.password')), 'min' => ':min']),
            'password.max' => __('validation.max.string', ['attribute' => strtolower(__('cruds.user.fields.password')), 'max' => ':max']),
            'password.regex' => __('validation.password.regex', ['attribute' => strtolower(__('cruds.user.fields.password'))]),


            'email.required' => __('validation.required', ['attribute' => strtolower(__('cruds.user.fields.email'))]),
            'email.ends_with' => __('validation.ends_with', ['attribute' => strtolower(__('cruds.user.fields.email'))]),
            'email.unique' => __('validation.unique', ['attribute' => strtolower(__('cruds.user.fields.email'))]),


            'username.required' => __('validation.required', ['attribute' => strtolower(__('cruds.user.fields.user_name'))]),
            'username.string' => __('validation.string', ['attribute' => strtolower(__('cruds.user.fields.user_name'))]),
            'username.unique' => __('validation.unique', ['attribute' => strtolower(__('cruds.user.fields.user_name'))]),
        ];
    }
}
