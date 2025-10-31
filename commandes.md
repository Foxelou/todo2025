
## Création d'un nouveau seeder:
```bash
php artisan make:seeder CategoriesSeeder
php artisan db:seed --class=CategoriesSeeder
```
 
puis rajouter le seeder dans le fichier : `database\seeders\DatabaseSeeder.php`

## Executer le seeder:
```
php artisan migrate:fresh --seed
```