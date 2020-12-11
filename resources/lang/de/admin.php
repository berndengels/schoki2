<?php

return [
    'admin-customer' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New Customer',
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

    'customer' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New Customer',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email verified at',
            'password' => 'Password',
            'stripe_id' => 'Stripe',
            'card_brand' => 'Card brand',
            'card_last_four' => 'Card last four',
            'trial_ends_at' => 'Trial ends at',

        ],
    ],

    'address-category' => [
        'title' => 'Address Catergory',

        'actions' => [
            'index' => 'Address Catergory',
            'create' => 'New Address Catergory',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    'address' => [
        'title' => 'Address',

        'actions' => [
            'index' => 'Address',
            'create' => 'New Address',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'address_category_id' => 'Address category',
            'email' => 'Email',
            'token' => 'Token',
            'info_on_changes' => 'Info on changes',

        ],
    ],

    'music-style' => [
        'title' => 'Music Style',

        'actions' => [
            'index' => 'Music Style',
            'create' => 'New Music Style',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',

        ],
    ],

    'message' => [
        'title' => 'Message',

        'actions' => [
            'index' => 'Message',
            'show' => 'Message from :name',
            'create' => 'New Message',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'music_style_id' => 'Music style',
            'email' => 'Email',
            'name' => 'Name',
            'message' => 'Message',

        ],
    ],

    'news' => [
        'title' => 'News',

        'actions' => [
            'index' => 'News',
            'create' => 'New News',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'end_date' => 'End date',
            'title' => 'Title',
            'text' => 'Text',
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',
            'show_item' => 'Show item',
            'is_published' => 'Is published',

        ],
    ],

    'menu' => [
        'title' => 'Menu',

        'actions' => [
            'index' => 'Menu',
            'create' => 'New Menu',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'parent_id' => 'Parent',
            'menu_item_type_id' => 'Menu item type',
            'name' => 'Name',
            'icon' => 'Icon',
            'fa_icon' => 'Fa icon',
            'url' => 'Url',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'lvl' => 'Lvl',
            'api_enabled' => 'Api enabled',
            'is_published' => 'Is published',

        ],
    ],

    'newsletter-status' => [
        'title' => 'Newsletter Status',

        'actions' => [
            'index' => 'Newsletter Status',
            'create' => 'New Newsletter Status',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',

        ],
    ],

    'newsletter' => [
        'title' => 'Newsletter',

        'actions' => [
            'index' => 'Newsletter',
            'create' => 'New Newsletter',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'tag_id' => 'Tag',
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',

        ],
    ],

    'product' => [
        'title' => 'Product',

        'actions' => [
            'index' => 'Product',
            'create' => 'New Product',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    'order' => [
        'title' => 'Order',

        'actions' => [
            'index' => 'Order',
            'create' => 'New Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',

        ],
    ],

    'product' => [
        'title' => 'Product',

        'actions' => [
            'index' => 'Product',
            'create' => 'New Product',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'is_published' => 'Is published',
            'is_available' => 'Is available',
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',

        ],
    ],

    'order' => [
        'title' => 'Order',

        'actions' => [
            'index' => 'Order',
            'create' => 'New Order',
            'edit' => 'Edit :name',
            'export' => 'Export',
        ],

        'columns' => [
            'id' => 'ID',
            'shoppingcart_id' => 'Shoppingcart',
            'instance' => 'Instance',
            'content' => 'Content',
            'price_total' => 'Price total',
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',
            'delivered' => 'Delivered',

        ],
    ],

    'address-category' => [
        'title' => 'Address Category',

        'actions' => [
            'index' => 'Address Category',
            'create' => 'New Address Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'tag_id' => 'Tag',
            'name' => 'Name',

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

    // Do not delete me :) I'm used for auto-generation
];
