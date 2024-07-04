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
    'full_date_time'  => 'd-m-Y/ H\hi',
    'search_datetime_format' => '%Y-%m-%d/ %H:%i:%s',

    'role'=>[
        'super_admin'   => 1,
        'administrator' => 2,
        'supervisor'    => 3,
        'vendor'        => 4,
    ],

    'genders'=>[
        1=>'male',
        2=>'female'
    ],

    'civil_status'=>[
        1 => 'single',
        2 => 'married',
        3 => 'divorced',
        4 => 'widower',
        5 => 'free union',
    ],

    'employment_status'=>[
        1 =>'employed',
        2 =>'unemployed',
        3 =>'dependent',
        4 =>'independent',
        5 =>'retired',
        6 =>'own business',
        7 =>'rentier',
    ],

    'social_securities'=>[
        1=>'si',
        2=>'no',
    ],

    'identification_type'=>[
        1 => 'Cedula',
        2 => 'RUC',
        3 => 'Pasaporte'
    ],

    'identification_length'=>[
        1    => 10,
        2    => 13,
        3    => 16
    ],

    'identification_validation_regex'=>[
        1    => "/^\d+$/",
        2    => "/^\d+$/",
        3    => "/^[a-zA-Z0-9]+$/"
    ]

];
