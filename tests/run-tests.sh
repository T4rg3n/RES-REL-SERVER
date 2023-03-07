#!/bin/bash

php artisan migrate:refresh --seed
php artisan test tests/Feature/CategorieTest.php
php artisan test tests/Feature/CommentaireTest.php
php artisan test tests/Feature/FavorisTest.php