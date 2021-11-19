<?php

/*
    After any changes here, please run `php artisan permissions:assign` and remember 
    that if you delete role, users who had it will lose their access
*/
return [
    'roles' => [
        'admin',
        'client',
    ],

    'permissions' => [
        'shoppingCart.indexClient',
        'edit_productClient',
        'update_productClient',
        'delete_productClient',
        'pay',
        'store_productClient',
        'index_ordersClient',
        'shoppingCart.showClientCart',
    ],

    'assigns' => [
        'admin' => [

        ],
        'client' => [
            'shoppingCart.indexClient',
            'edit_productClient',
            'update_productClient',
            'delete_productClient',
            'pay',
            'store_productClient',
            'index_ordersClient',
            'shoppingCart.showClientCart',
        ],

    ]
];