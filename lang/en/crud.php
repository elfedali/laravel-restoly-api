<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'avatar' => 'Avatar',
        ],
    ],

    'menus' => [
        'name' => 'Menus',
        'index_title' => 'Menus List',
        'new_title' => 'New Menu',
        'create_title' => 'Create Menu',
        'edit_title' => 'Edit Menu',
        'show_title' => 'Show Menu',
        'inputs' => [
            'restaurant_id' => 'Restaurant',
            'title' => 'Title',
        ],
    ],

    'taxonomies' => [
        'name' => 'Taxonomies',
        'index_title' => 'Taxonomies List',
        'new_title' => 'New Taxonomy',
        'create_title' => 'Create Taxonomy',
        'edit_title' => 'Edit Taxonomy',
        'show_title' => 'Show Taxonomy',
        'inputs' => [
            'title' => 'Title',
            'slug' => 'Slug',
        ],
    ],

    'user_reviews' => [
        'name' => 'User Reviews',
        'index_title' => 'Reviews List',
        'new_title' => 'New Review',
        'create_title' => 'Create Review',
        'edit_title' => 'Edit Review',
        'show_title' => 'Show Review',
        'inputs' => [
            'reviewable_id' => 'Reviewable Id',
            'reviewable_type' => 'Reviewable Type',
            'content' => 'Content',
            'rating' => 'Rating',
        ],
    ],

    'restaurants' => [
        'name' => 'Restaurants',
        'index_title' => 'Restaurants List',
        'new_title' => 'New Restaurant',
        'create_title' => 'Create Restaurant',
        'edit_title' => 'Edit Restaurant',
        'show_title' => 'Show Restaurant',
        'inputs' => [
            'user_id' => 'User',
            'title' => 'Title',
            'slug' => 'Slug',
            'content' => 'Content',
            'excerpt' => 'Excerpt',
            'is_published' => 'Is Published',
            'comment_status' => 'Comment Status',
            'ping_status' => 'Ping Status',
            'published_at' => 'Published At',
            'thumbnail' => 'Thumbnail',
            'phone' => 'Phone',
            'phone_2' => 'Phone 2',
            'phone_3' => 'Phone 3',
            'reservation_required' => 'Reservation Required',
            'website_url' => 'Website Url',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
        ],
    ],

    'countries' => [
        'name' => 'Countries',
        'index_title' => 'Countries List',
        'new_title' => 'New Country',
        'create_title' => 'Create Country',
        'edit_title' => 'Edit Country',
        'show_title' => 'Show Country',
        'inputs' => [
            'title' => 'Title',
            'slug' => 'Slug',
        ],
    ],

    'cities' => [
        'name' => 'Cities',
        'index_title' => 'Cities List',
        'new_title' => 'New City',
        'create_title' => 'Create City',
        'edit_title' => 'Edit City',
        'show_title' => 'Show City',
        'inputs' => [
            'country_id' => 'Country',
            'title' => 'Title',
        ],
    ],

    'activities' => [
        'name' => 'Activities',
        'index_title' => 'Activities List',
        'new_title' => 'New Activity',
        'create_title' => 'Create Activity',
        'edit_title' => 'Edit Activity',
        'show_title' => 'Show Activity',
        'inputs' => [
            'activity_key' => 'Activity Key',
            'activity_content' => 'Activity Content',
            'user_id' => 'User',
        ],
    ],

    'reviews' => [
        'name' => 'Reviews',
        'index_title' => 'Reviews List',
        'new_title' => 'New Review',
        'create_title' => 'Create Review',
        'edit_title' => 'Edit Review',
        'show_title' => 'Show Review',
        'inputs' => [
            'user_id' => 'User',
            'reviewable_id' => 'Reviewable Id',
            'reviewable_type' => 'Reviewable Type',
            'content' => 'Content',
            'rating' => 'Rating',
        ],
    ],

    'demandes' => [
        'name' => 'Demandes',
        'index_title' => 'Demandes List',
        'new_title' => 'New Demande',
        'create_title' => 'Create Demande',
        'edit_title' => 'Edit Demande',
        'show_title' => 'Show Demande',
        'inputs' => [
            'user_id' => 'User',
            'demandeable_id' => 'Demandeable Id',
            'demandeable_type' => 'Demandeable Type',
        ],
    ],

    'favorites' => [
        'name' => 'Favorites',
        'index_title' => 'Favorites List',
        'new_title' => 'New Favorite',
        'create_title' => 'Create Favorite',
        'edit_title' => 'Edit Favorite',
        'show_title' => 'Show Favorite',
        'inputs' => [
            'user_id' => 'User',
            'favoritable_id' => 'Favoritable Id',
            'favoritable_type' => 'Favoritable Type',
        ],
    ],

    'metas' => [
        'name' => 'Metas',
        'index_title' => 'Metas List',
        'new_title' => 'New Meta',
        'create_title' => 'Create Meta',
        'edit_title' => 'Edit Meta',
        'show_title' => 'Show Meta',
        'inputs' => [
            'metaable_id' => 'Metaable Id',
            'metaable_type' => 'Metaable Type',
            'meta_key' => 'Meta Key',
        ],
    ],

    'pings' => [
        'name' => 'Pings',
        'index_title' => 'Pings List',
        'new_title' => 'New Ping',
        'create_title' => 'Create Ping',
        'edit_title' => 'Edit Ping',
        'show_title' => 'Show Ping',
        'inputs' => [
            'pingable_id' => 'Pingable Id',
            'pingable_type' => 'Pingable Type',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'note' => 'Note',
            'is_active' => 'Is Active',
        ],
    ],

    'promotions' => [
        'name' => 'Promotions',
        'index_title' => 'Promotions List',
        'new_title' => 'New Promotion',
        'create_title' => 'Create Promotion',
        'edit_title' => 'Edit Promotion',
        'show_title' => 'Show Promotion',
        'inputs' => [
            'price' => 'Price',
            'price_promo' => 'Price Promo',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'promotionable_id' => 'Promotionable Id',
            'promotionable_type' => 'Promotionable Type',
        ],
    ],

    'menu_items' => [
        'name' => 'Menu Items',
        'index_title' => 'MenuItems List',
        'new_title' => 'New Menu item',
        'create_title' => 'Create MenuItem',
        'edit_title' => 'Edit MenuItem',
        'show_title' => 'Show MenuItem',
        'inputs' => [
            'menu_id' => 'Menu',
            'title' => 'Title',
            'ingredients' => 'Ingredients',
            'price' => 'Price',
            'is_disponible' => 'Is Disponible',
            'is_vegetarian' => 'Is Vegetarian',
            'picture' => 'Picture',
        ],
    ],

    'neighborhoods' => [
        'name' => 'Neighborhoods',
        'index_title' => 'Neighborhoods List',
        'new_title' => 'New Neighborhood',
        'create_title' => 'Create Neighborhood',
        'edit_title' => 'Edit Neighborhood',
        'show_title' => 'Show Neighborhood',
        'inputs' => [
            'title' => 'Title',
            'city_id' => 'City',
        ],
    ],

    'user_favorites' => [
        'name' => 'User Favorites',
        'index_title' => 'Favorites List',
        'new_title' => 'New Favorite',
        'create_title' => 'Create Favorite',
        'edit_title' => 'Edit Favorite',
        'show_title' => 'Show Favorite',
        'inputs' => [
            'favoritable_id' => 'Favoritable Id',
            'favoritable_type' => 'Favoritable Type',
        ],
    ],

    'user_demandes' => [
        'name' => 'User Demandes',
        'index_title' => 'Demandes List',
        'new_title' => 'New Demande',
        'create_title' => 'Create Demande',
        'edit_title' => 'Edit Demande',
        'show_title' => 'Show Demande',
        'inputs' => [
            'demandeable_id' => 'Demandeable Id',
            'demandeable_type' => 'Demandeable Type',
        ],
    ],

    'taxonomy_terms' => [
        'name' => 'Taxonomy Terms',
        'index_title' => 'Terms List',
        'new_title' => 'New Term',
        'create_title' => 'Create Term',
        'edit_title' => 'Edit Term',
        'show_title' => 'Show Term',
        'inputs' => [
            'title' => 'Title',
            'slug' => 'Slug',
        ],
    ],
];
