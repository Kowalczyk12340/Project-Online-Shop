<?php

return[
    'menu' => [
        'dictionaries' => 'Słowniki',
        'administration' => 'Administracja',
        'users' => 'Użytkownicy',
        'log-viewer' => 'Logi',
        'profile' => 'Profil',
        'settings' => 'Ustawienia'
    ],
    'labels' => [
        'pln' => 'zł',
        'select2-placeholder' => 'Wybierz opcję'
    ],
'buttons' => [
        'cancel' => 'Anuluj',
        'store' => 'Dodaj',
        'delete' => 'Usuń',
        'update' => 'Aktualizuj',
        'yes' => 'Tak',
        'no' => 'Nie'
],
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
    ],
    'flashes' => [
        'success' => [
            'stored' => 'Dodano kategorię :name',
            'updated' => 'Zaktualizowano kategorię :name',
            'nothing-changed' => 'Dane kategorii :name nie zmieniły się',
            'destroy' => 'Kategoria :name została usunięty',
            'restore' => 'Usunięcie kategorii :name zostało anulowane'
        ]
    ],
    'edit' => 'Edycja danych kategorii',
    'destroy' => 'Usunięcie kategorii',
    'destroy-question' => 'Czy na pewno usunąć kategorię :name?',
    'restore' => 'Anulowanie usunięcia kategorii',
    'restore-question' => 'Czy anulować usunięcie kategorii :name?'
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
    ],
    'flashes' => [
        'success' => [
            'stored' => 'Dodano produkt :name',
            'updated' => 'Zaktualizowano produkt :name',
            'nothing-changed' => 'Dane produktu :name nie zmieniły się',
            'destroy' => 'Produkt :name został usunięty',
            'restore' => 'Usunięcie produktu :name zostało anulowane'
        ]
    ],
    'edit' => 'Edycja danych produktu',
            'destroy' => 'Usunięcie produktu',
            'destroy-question' => 'Czy na pewno usunąć produkt :name?',
            'restore' => 'Anulowanie usunięcia produktu',
            'restore-question' => 'Czy anulować usunięcie produktu :name?'
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
            'userName' => 'Imie i Nazwisko',
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

