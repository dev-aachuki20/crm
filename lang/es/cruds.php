<?php

return [
    'userManagement' => [
        'title'          => 'Gestión de usuarios',
        'title_singular' => 'Gestión de usuarios',
    ],
    'user'           => [
        'title'          => 'Usuarios',
        'title_singular' => 'Usuario',
        'fields'         => [
            'id'                       => 'ID',
            'first_name'               => 'Nombre',
            'last_name'                => 'Apellido',
            'name'                     => 'Nombre',
            'full_name'                => 'Nombre completo',
            'user_name'                => 'Nombre de usuario',
            'birthdate'                => 'Fecha de nacimiento',
            'email'                    => 'Correo electrónico',
            'phone'                    => 'Número de teléfono',
            'dob'                      => 'Fecha de nacimiento',
            'profile_image'            => 'Imagen de perfil',
            'email_verified_at'        => 'Correo electrónico verificado el',
            'password'                 => 'Contraseña',
            'repeat_password'          => 'Repeat Password',
            'confirm_password'         => 'Password Confirm',
            'role'                     => 'Role',
            'date_of_join'             => 'Fecha de ingreso',
            'my_referral_code'         => 'Mi código de referencia',
            'referral_code'            => 'Código de referencia',
            'referral_name'            => 'Nombre de referencia',
            'remember_token'           => 'Recordar token',
            'created_at'               => 'Creado el',
            'updated_at'               => 'Actualizado el',
            'deleted_at'               => 'Eliminado el',
            'sponser_id'               => 'ID del patrocinador',
            'sponser_name'             => 'Nombre del patrocinador',
            'joining_date'             => 'Fecha de ingreso',
            'registration_date'        => 'Fecha de Registro',
        ],

        'profile'         => [
            'guardian_name'            => 'Nombre del tutor',
            'gender'                   => 'Género',
            'profession'               => 'Profesión',
            'marital_status'           => 'Estado civil',
            'address'                  => 'Dirección',
            'state'                    => 'Estado',
            'city'                     => 'Ciudad',
            'pin_code'                 => 'Código PIN',
            'nominee_name'             => 'Nombre del beneficiario',
            'nominee_dob'              => 'Fecha de nacimiento del beneficiario',
            'nominee_relation'         => 'Relación con el beneficiario',
            'level_one_user'           => 'Usuario de nivel 1',
            'level_two_user'           => 'Usuario de nivel 2',
            'level_three_user'         => 'Usuario de nivel 3',
            'created_at'               => 'Creado el',
            'updated_at'               => 'Actualizado el',
            'deleted_at'               => 'Eliminado el',
            'avatar'                   => 'Avatar',
            'upload_photo'             => 'Subir foto',
        ],

    ],

    'permission'     => [
        'title'          => 'Permisos',
        'title_singular' => 'Permiso',
        'fields'         => [
            'id'                => 'ID',
            'title'             => 'Título',
            'created_at'        => 'Creado el',
            'updated_at'        => 'Actualizado el',
            'deleted_at'        => 'Eliminado el',
        ],
    ],

    'setting' => [
        'title' => 'Configuraciones',
        'title_singular' => 'Configuración',
        'fields' => [
            'key'   => 'Clave',
            'value' => 'Valor',
            'display_name' => 'Nombre de visualización',
            'group' => 'Grupo',
            'type'  => 'Tipo',
            'created_by'     => 'Creado por',
        ],
    ],

    'channel' => [
        'title' => 'Canales',
        'title_singular' => 'Canal',
        'fields' => [
            'description'    => 'Descripción',
        ],
    ],

    'campaign' => [
        'title' => 'Campañas',
        'title_singular' => 'Campaña',
        'fields' => [
            'description'       => 'Descripción',
            'campaign'          => 'Campaña',
            'assigned_channel'  => 'Canal asignado',
            'created_at'        => 'Creado en',
            'updated_at'        => 'Actualizado en',
            'deleted_at'        => 'Eliminado en',
            'qualification'     => 'Calificación',
        ],
    ],

    'interaction' => [
        'title' => 'Interacciones',
        'title_singular' => 'Interacción',
        'fields' => [
            'description'    => 'Descripción',
        ],
    ],

    'lead' => [
        'title' => 'Clientes potenciales',
        'title_singular' => 'Cliente potencial',
        'fields' => [
            'description'    => 'Descripción',
        ],
    ],

    'search_by_identification' => 'Buscar por identificación',
    'search_id' => 'Busca la identificación',
    'edit' => 'Editar',
    'save' => 'Ahorrar',
    'cancel' => 'Cancelar',
    'add'    => 'Agregar',
    'list_created_channel'    => 'Lista de canales creados',
    'new' => 'Nueva',


];
