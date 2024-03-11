<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Request Type List
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the request type list 
    |
    */ 
    'app_name' => env('APP_NAME', 'CRM'),
    'app_mode' => env('APP_MODE', 'staging'),
    'owner_email_id' => 'rohithelpfullinsight@gmail.com',

    'default' => [
        'logo' => 'images/logo.png',
        'favicon' => 'images/favicon.png',
        'short_logo' => 'images/logo-mini.png',
        'transparent_logo' => 'assets/logo/logo-transparent.png',
        'profile_image' => 'default/default-user.svg',
        'footer-logo'   => 'images/light-logo.png',
        'no-image' => 'images/no-image.jpg',
        'email_logo'=>'images/crm-logo.png',
    ],

    'date_format'     => 'd-m-Y',
    'datetime_format' => 'd-m-Y H:i',
    'time_format'     => 'H:i:s',

    'genders'=>[
        1=>'male',
        2=>'female',
    ],

    'civil_status'=>[
        1 => 'single', 
        2 => 'married', 
        3 => 'divorced', 
        4 => 'widower'
    ],

    'employment_status'=>[
        1=>'employee', 
        2=>'unemployed',
    ],

    'social_securities'=>[
        1=>'si', 
        2=>'no',
    ]
    
];