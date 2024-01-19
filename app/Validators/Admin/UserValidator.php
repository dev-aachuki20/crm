<?php
namespace App\Validators\Admin;

use App\Validators\Validator;

class UserValidator extends Validator
{
    /**
     * Rules for User registration
     *
     * @var array
     */

    public function __construct($validationFor = 'add')
    {
        $commonRules = [
            'old_password'       => 'required',
            'password'              => 'required|string|min:8|max:12',
            'confirm_password'=> 'required|string|min:8|max:12',
        ];
    
        if ($validationFor === 'update_profile') {
            $commonRules = [
                'first_name'         => 'nullable',
                'last_name'          => 'nullable',
                'name'               => 'nullable',
                'username'           => 'nullable',
                'email'              => 'nullable',
                'birthdate'          => 'nullable',
                'old_password'       => 'required',
                'password'           => 'required|string|min:8|max:12',
                'confirm_password'   => 'required|string|min:8|max:12',
            ];
        }

        // $customMessages = [
            
        // ];
    
        $this->rules = $commonRules;
        // $this->customMessages = $customMessages;

    }
    // public function getCustomMessages()
    // {
    //     return $this->customMessages ?? [];
    // }

    public function getValidationErrors()
    {
        return $this->validationErrors ?? [];
    }


} 