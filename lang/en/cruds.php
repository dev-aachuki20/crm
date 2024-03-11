<?php

return [
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
            'registration_date'        => 'Registration Date',
            'campaign_id'              => 'Campaign',
            'image'                    => 'Image'
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

    'area' => [
        'title' => 'Area',
        'title_singular' => 'Area',
        'fields' => [
            'description'    => 'Description',
            'name' => 'Area Name',
        ],
    ],

    'campaign' => [
        'title' => 'Campaigns',
        'title_singular' => 'campaign',
        'fields' => [
            'description'       => 'Description',
            'campaign'          => 'Campaign',
            'campaign_name'     => 'Campaign Name',
            'assigned_area'  => 'Assigned Area',
            'created_by'        => 'Created By',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
            'qualification'     => 'Qualification',
            'new_campaign'      => 'Enter the new Campaign',
            'update_campaign'   => 'Enter the Edit Campaign',
            'qualification_field_required' => 'The Qualification field is required.',
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
    'list_created_area'    => 'List Of Created Area',
    'new' => 'New',
    'enter_new_area' => 'Enter the new area',
    'are_you_sure' => 'Are you sure?',
    'delete_this_record' => 'You want to delete this record!',
    'yes_delete' => 'Yes, delete it!',
    'new_user' => 'New User',
    'upload' => 'Upload',
    'send_password_to_mail' => 'Send password to email',
    'show' => 'Show',
    'entries' => 'entries',
    'search' => 'Search',
    'previous' => 'Previous',
    'next' => 'Next',
    'data_not_found' => 'Data not found',
    'processing'   => 'Processing...',

    'genders' => [
        'male'   => 'Male',
        'female' => 'Female',
    ],

    'civil_status'=>[
        'single'   => 'Single',
        'married'  => 'Married',
        'divorced' => 'Divorced',
        'widower'  => 'Widower',
    ]
];
