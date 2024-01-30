<?php

namespace App\Http\Requests;

use App\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UserRequest extends FormRequest
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
            'email'         => 'required|email|max:255',
            'birthdate'     => 'required|date_format:Y-m-d',
            'username'      => 'required|string|max:255',
            'password'      => 'required|string|min:8',
            'role'          => 'exists:roles,id',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'campaign_id'   => 'required|array',
        ];
    }
}
