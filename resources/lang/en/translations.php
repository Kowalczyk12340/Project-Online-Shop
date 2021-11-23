<?php

return[
'categories' =>[
    'create' => [
        'save' => 'Zapisz',
        'editCategory' => 'Edytuj kategorie',
        'addCategory' => 'Dodaj kategorie',
        'back' => 'Powrót',
    ],

    'index' => [
        'categories' => 'Kategorie',
        'id' => 'Id',
        'categoryName' => 'Nazwa kategorii',
        'created_at' => 'Data dodania',
        'updated_at' => 'Data modyfikacji',
        'deleted_at' => 'Data usunięcia',
        'edit' => 'Edytuj',
        'delete' => 'Usuń',
        'img' => 'Zdjęcie',
    ]
],

'products' =>[
    'create' => [
        'save' => 'Zapisz',
        'editProduct' => 'Edytuj produkt',
        'addProduct' => 'Dodaj produkt',
        'back' => 'Powrót',
    ],

    'index' => [
        'products' => 'Produkty',
        'id' => 'Id',
        'productName' => 'Nazwa produktu',
        'productCategory' => 'Kategoria produktu',
        'productUnit' => 'Jednostka',
        'productUnitPrice' => 'Cena jednostkowa',
        'productStockStatus' => 'Stan magazynu',
        'productDescription' => 'Opis',
        'created_at' => 'Data dodania',
        'updated_at' => 'Data modyfikacji',
        'deleted_at' => 'Data usunięcia',
        'edit' => 'Edytuj',
        'delete' => 'Usuń',
        'details' => 'Szczegóły',
        'productQuantity' => 'Ilość',
        'productsSum' => 'Razem',
        'img' => 'Zdjęcie',
    ]
],

    'users' =>[
        'create' => [
            'save' => 'Zapisz',
            'editUser' => 'Edytuj użytkownika',
            'addUser' => 'Dodaj użytkownika',
            'back' => 'Powrót',
        ],
    
        'index' => [
            'users' => 'Użytkownicy',
            'id' => 'Id',
            'userName' => 'Imie',
            'userSurname' => 'Nazwisko',
            'userEmail' => 'Email',
            'created_at' => 'Data dodania',
            'updated_at' => 'Data modyfikacji',
            'deleted_at' => 'Data usunięcia',
            'edit' => 'Edytuj',
            'delete' => 'Usuń',
            'details' => 'Szczegóły',
            'img' => 'Zdjęcie',
        ]
    ],

    'shoppingCarts' =>[
        'create' => [
            'save' => 'Zapisz',
            'editUser' => 'Edytuj koszyk',
            'back' => 'Powrót',
        ],
    
        'index' => [
            'shoppingCarts' => 'Koszyki',
            'id' => 'Id',
            'ownershoppingCart' => 'Imię, nazwisko (email)',
            'created_at' => 'Data dodania',
            'updated_at' => 'Data modyfikacji',
            'deleted_at' => 'Data usunięcia',
            'edit' => 'Edytuj',
            'delete' => 'Usuń',
            'details' => 'Szczegóły',
            'statusshoppingCart' => 'Status',
        ]
    ],
];

