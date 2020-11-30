<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'category-model' => [
        'title' => 'Category',

        'actions' => [
            'index' => 'Category',
            'create' => 'New Category',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'icon' => 'Icon',
            
        ],
    ],

    'category' => [
        'title' => 'Category',

        'actions' => [
            'index' => 'Category',
            'create' => 'New Category',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'icon' => 'Icon',
            
        ],
    ],

    'theme' => [
        'title' => 'Category',

        'actions' => [
            'index' => 'Category',
            'create' => 'New Category',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'icon' => 'Icon',
            
        ],
    ],

    'page' => [
        'title' => 'Category',

        'actions' => [
            'index' => 'Category',
            'create' => 'New Category',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'icon' => 'Icon',
            
        ],
    ],

    'event' => [
        'title' => 'Category',

        'actions' => [
            'index' => 'Category',
            'create' => 'New Category',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'icon' => 'Icon',
            
        ],
    ],

    'event-periodic' => [
        'title' => 'Category',

        'actions' => [
            'index' => 'Category',
            'create' => 'New Category',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'icon' => 'Icon',
            
        ],
    ],

    'event-template' => [
        'title' => 'Category',

        'actions' => [
            'index' => 'Category',
            'create' => 'New Category',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'icon' => 'Icon',
            
        ],
    ],

    'theme' => [
        'title' => 'Theme',

        'actions' => [
            'index' => 'Theme',
            'create' => 'New Theme',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'icon' => 'Icon',
            
        ],
    ],

    'event-template' => [
        'title' => 'Event Template',

        'actions' => [
            'index' => 'Event Template',
            'create' => 'New Event Template',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'theme_id' => 'Theme',
            'category_id' => 'Category',
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'links' => 'Links',
            
        ],
    ],

    'event-periodic' => [
        'title' => 'Event Periodic',

        'actions' => [
            'index' => 'Event Periodic',
            'create' => 'New Event Periodic',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'theme_id' => 'Theme',
            'category_id' => 'Category',
            'periodic_position' => 'Periodic position',
            'periodic_weekday' => 'Periodic weekday',
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'links' => 'Links',
            'event_date' => 'Event date',
            'event_time' => 'Event time',
            'price' => 'Price',
            'is_published' => 'Is published',
            
        ],
    ],

    'page' => [
        'title' => 'Page',

        'actions' => [
            'index' => 'Page',
            'create' => 'New Page',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',
            'title' => 'Title',
            'slug' => 'Slug',
            'body' => 'Body',
            'is_published' => 'Is published',
            
        ],
    ],

    'event' => [
        'title' => 'Event',

        'actions' => [
            'index' => 'Event',
            'create' => 'New Event',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'theme_id' => 'Theme',
            'category_id' => 'Category',
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'links' => 'Links',
            'event_date' => 'Event date',
            'event_time' => 'Event time',
            'price' => 'Price',
            'is_published' => 'Is published',
            'is_periodic' => 'Is periodic',
            
        ],
    ],

    'role' => [
        'title' => 'Roles',

        'actions' => [
            'index' => 'Roles',
            'create' => 'New Role',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'guard_name' => 'Guard name',
            
        ],
    ],

    'permission' => [
        'title' => 'Permissions',

        'actions' => [
            'index' => 'Permissions',
            'create' => 'New Permission',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'guard_name' => 'Guard name',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];