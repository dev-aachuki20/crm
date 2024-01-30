<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

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
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|unique:users,email,' . $userId . '|max:255',
            'birthdate'     => 'required|date_format:Y-m-d',
            'username'      => 'required|string|unique:users,username,' . $userId . '|max:255',
            // 'password'      => 'required|string|min:8',
            'role'          => 'exists:roles,id',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'campaign_id'   => 'nullable|array',
            'campaign_id'   => 'nullable',
        ];

        if (isset($userId)) {
            unset($rules['password']);
        } else {
            $rules['password'] = 'required|string|min:8|max:12';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => __('validation.user.required'),
            'last_name.required' => __('validation.user.required'),
            'email.required' => __('validation.user.required'),
            'birthdate.required' => __('validation.user.required'),
            'username.required' => __('validation.user.required'),
            'password.required' => __('validation.user.required'),

        ];
    }
}
