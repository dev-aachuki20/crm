<?php

namespace App\Http\Requests\Profile;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Rules\NoMultipleSpacesRule;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        // abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'first_name'            => ['required','regex:/^[a-zA-Z\s]+$/','string','max:255',new NoMultipleSpacesRule],
            'last_name'             => ['required','regex:/^[a-zA-Z\s]+$/','string','max:255',new NoMultipleSpacesRule],
            'email'                 => 'nullable|email|max:255',
            'birthdate'             => 'required|date|before_or_equal:' . now()->format('Y-m-d'),
            'password'              => 'nullable|string|min:8|max:15|confirmed|regex:/^(?!.*\s)(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required_with:password|same:password',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif',
            // 'campaign'              => 'required',
            // 'campaign.*'            => 'required',
            // |max:2048
        ];
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
            'birthdate.before' => __('validation.before', ['attribute' => strtolower(__('cruds.user.fields.birthdate'))]),

            'image.nullable' => __('validation.image', ['attribute' => strtolower(__('cruds.user.fields.image'))]),
            'image.image' => __('validation.image', ['attribute' => strtolower(__('cruds.user.fields.image'))]),
            'image.mimes' => __('validation.mimes', ['attribute' => strtolower(__('cruds.user.fields.image')), 'values' => 'jpeg, png, jpg, gif']),
            // 'image.max' => __('validation.max.file', ['attribute' => strtolower(__('cruds.user.fields.image')), 'max' => ':max']),

            'campaign.required' => __('validation.required', ['attribute' => strtolower(__('cruds.user.fields.campaign_id'))]),

            'password.nullable' => __('validation.password', ['attribute' => strtolower(__('cruds.user.fields.password'))]),
            'password.string' => __('validation.string', ['attribute' => strtolower(__('cruds.user.fields.password'))]),
            'password.min' => __('validation.min.string', ['attribute' => strtolower(__('cruds.user.fields.password')), 'min' => ':min']),
            'password.max' => __('validation.max.string', ['attribute' => strtolower(__('cruds.user.fields.password')), 'max' => ':max']),
            'password.regex' => __('validation.password.regex', ['attribute' => strtolower(__('cruds.user.fields.password'))]),
            'password_confirmation.required' => __('validation.required', ['attribute' => strtolower(__('cruds.user.fields.password_confirmation'))]),


            'email.nullable' => __('validation.email', ['attribute' => strtolower(__('cruds.user.fields.email'))]),

        ];
    }
}
