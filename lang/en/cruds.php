<?php

return [
    'userManagement' => [
        'title'          => 'User Management',
        'title_singular' => 'User Management',
    ],
    'user'           => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'first_name'               => 'First Name',
            'last_name'                => 'Last Name',
            'name'                     => 'Name',
            'full_name'                => 'Full name',
            'user_name'                 => 'Username',
            'birthdate'                => 'Birthdate',
            'email'                    => 'Email',
            'phone'                    => 'Phone Number',
            'profile_image'            => 'Profile Image',
            'email_verified_at'        => 'Email verified at',
            'password'                 => 'Password',
            'repeat_password'          => 'Repeat Password',
            'confirm_password'         => 'Password Confirm',
            'role'                     => 'Role',
            'date_of_join'             => 'Date Of Join',
            'my_referral_code'         => 'My referral code',
            'referral_code'            => 'Referral code',
            'referral_name'            => 'Referral Name',
            'remember_token'           => 'Remember Token',
            'created_at'               => 'Created at',
            'updated_at'               => 'Updated at',
            'deleted_at'               => 'Deleted at',
            'sponser_id'               => 'Sponser ID',
            'joining_date'             => 'Joining Date',
        ],

        'profile'         => [
            'guardian_name'            => 'Guardian name',
            'gender'                   => 'Gender',
            'profession'               => 'Profession',
            'marital_status'           => 'Marital status',
            'address'                  => 'Address',
            'state'                    => 'State',
            'city'                     => 'City',
            'pin_code'                 => 'Pin code',
            'nominee_name'             => 'Nominee name',
            'nominee_dob'              => 'Nominee DOB',
            'nominee_relation'         => 'Nominee relation',
            'level_one_user'           => 'Level 1 user',
            'level_two_user'           => 'Level 2 user',
            'level_three_user'         => 'Level 3 user',
            'created_at'               => 'Created at',
            'updated_at'               => 'Updated at',
            'deleted_at'               => 'Deleted at',
            'avatar'                   => 'Avatar',
            'upload_photo'             => 'Upload Photo',
        ],
    ],

    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'title'             => 'Title',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],

    'setting' => [
        'title' => 'Settings',
        'title_singular' => 'Setting',
        'fields' => [
            'key'   => 'Key',
            'value' => 'Value',
            'display_name' => 'Display Name',
            'group' => 'Group',
            'type'  => 'Type',
            'created_by'     => 'Created by',
        ],
    ],

    'channel' => [
        'title' => 'Channels',
        'title_singular' => 'Channel',
        'fields' => [
            'description'    => 'Description',
        ],
    ],

    'campaign' => [
        'title' => 'campaigns',
        'title_singular' => 'campaign',
        'fields' => [
            'description'    => 'Description',
        ],
    ],

    'interaction' => [
        'title' => 'Interactions',
        'title_singular' => 'Interaction',
        'fields' => [
            'description'    => 'Description',
        ],
    ],

    'lead' => [
        'title' => 'Leads',
        'title_singular' => 'Lead',
        'fields' => [
            'description'    => 'Description',
        ],
    ],

    'search_by_identification' => 'Search by identification',
    'search_id' => 'Search the ID',
    'edit' => 'Edit',
    'save' => 'Save',
    'cancel' => 'Cancel',
    'add'    => 'Add',
    'list_created_channel'    => 'List Of Created Channel',


];
