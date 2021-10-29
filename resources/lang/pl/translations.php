<?php

return [
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
        'update' => 'Aktualizuj',
        'yes' => 'Tak',
        'no' => 'Nie'
    ],
    'attribute' => [
        'created_at' => 'utworzono',
        'updated_at' => 'zaktualizowano',
        'deleted_at' => 'usunięto',
    ],
    'categories' => [
        'title' => 'Kategorie',
        'labels' => [
            'create' => 'Dodanie nowej kategorii',
            'edit' => 'Edycja danych kategorii',
            'destroy' => 'Usunięcie kategorii',
            'destroy-question' => 'Czy na pewno usunąć kategorię :name?',
            'restore' => 'Anulowanie usunięcia kategorii',
            'restore-question' => 'Czy anulować usunięcie kategorii :name?'
        ],
        'attribute' => [
            'name' => 'nazwa',
            'count_products' => 'ilość produktów'
        ],
        'flashes' => [
            'success' => [
                'stored' => 'Dodano kategorię :name',
                'updated' => 'Zaktualizowano kategorię :name',
                'nothing-changed' => 'Dane kategorii :name nie zmieniły się',
                'destroy' => 'Kategoria :name została usunięty',
                'restore' => 'Usunięcie kategorii :name zostało anulowane'
            ]
        ]
    ],

    'manufacturers' => [
        'title' => 'Producenci',
        'labels' => [
            'create' => 'Dodanie nowego producenta',
            'edit' => 'Edycja danych producenta',
            'destroy' => 'Usunięcie producenta',
            'destroy-question' => 'Czy na pewno usunąć producenta :name?',
            'restore' => 'Anulowanie usunięcia producenta',
            'restore-question' => 'Czy anulować usunięcie producenta :name?'
        ],
        'attribute' => [
            'name' => 'nazwa',
            'address' => 'adres',
            'count_products' => 'ilość produktów',
            'owner' => 'właściciel'
        ],
        'flashes' => [
            'success' => [
                'stored' => 'Dodano producenta :name',
                'updated' => 'Zaktualizowano producenta :name',
                'nothing-changed' => 'Dane producenta :name nie zmieniły się',
                'destroy' => 'Producent :name został usunięty',
                'restore' => 'Usunięcie producenta :name zostało anulowane'
            ]
        ]
    ],

    'products' => [
        'title' => 'Produkty',
        'labels' => [
            'create' => 'Dodanie nowego produktu',
            'edit' => 'Edycja danych produktu',
            'destroy' => 'Usunięcie produktu',
            'destroy-question' => 'Czy na pewno usunąć produkt :name?',
            'restore' => 'Anulowanie usunięcia produktu',
            'restore-question' => 'Czy anulować usunięcie produktu :name?'
        ],
        'attribute' => [
            'name' => 'nazwa',
            'description' => 'opis',
            'category' => 'kategoria',
            'manufacturers' => 'producenci'
        ],
        'flashes' => [
            'success' => [
                'stored' => 'Dodano produkt :name',
                'updated' => 'Zaktualizowano produkt :name',
                'nothing-changed' => 'Dane produktu :name nie zmieniły się',
                'destroy' => 'Produkt :name został usunięty',
                'restore' => 'Usunięcie produktu :name zostało anulowane'
            ]
        ]
    ],
];
