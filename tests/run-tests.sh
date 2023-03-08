#!/bin/bash

php artisan migrate:refresh --seed
php artisan test tests/Feature/CategorieTest.php
php artisan test tests/Feature/CommentaireTest.php
php artisan test tests/Feature/FavorisTest.php
php artisan test tests/Feature/GroupeTest.php
php artisan test tests/Feature/PieceJointeTest.php
php artisan test tests/Feature/RelationTest.php
php artisan test tests/Feature/ReponseCommentaireTest.php
php artisan test tests/Feature/RessourceTest.php
php artisan test tests/Feature/RoleTest.php
php artisan test tests/Feature/TypeRelationTest.php
php artisan test tests/Feature/UtilisateurTest.php