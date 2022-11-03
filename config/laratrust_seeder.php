<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [

        'super_admin' => [
            'admins'       => 'c,r,u,d',
            'roles'        => 'c,r,u,d',
            'users'        => 'c,r,u,d',
            'faqs'         => 'c,r,u,d',
            'cities'       => 'c,r,u,d',
            'languages'    => 'c,r,u,d',
            'nationals'    => 'c,r,u,d',
            'relations'    => 'c,r,u,d',
            'aboutus'      => 'r,u',
            'terms'        => 'r,u',
            'usages'       => 'r,u',
            'privecy'      => 'r,u',
            'settings'     => 'r,u',
            'contactus'    => 'r,d',
        ],
        // 'role_name' => [
        //     'module_1_name' => 'c,r,u,d',
        // ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
