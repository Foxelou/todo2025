<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Todos;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'libelle' => 'Pro'],
            ['id' => 2, 'libelle' => 'Famille'],
            ['id' => 3, 'libelle' => 'Sport'],
            ['id' => 4, 'libelle' => 'Associatif'],
            // Ajoutez d'autres catégories au besoin
        ];

        // Insertion des données dans la table 'categories'
        DB::table('categories')->insert($categories);


        // Récupérer la todo "Sortir le chien"
        $todo = Todos::where('texte', 'Sortir le chien')->first();

        if ($todo) {
            // Attacher la catégories 3 (Sport) à la todo
            $todo->categories()->attach(3);
        }
    }
}
?>