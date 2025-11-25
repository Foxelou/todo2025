<?php

namespace Database\Seeders;

use App\Models\Todos;
use Illuminate\Database\Seeder;

class UsersTodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer la todo "Nettoyer la cuisine"
        $todo = Todos::where('texte', 'Nettoyer la cuisine')->first();

        if ($todo) {
            $todo->users()->attach(1);
        }

        $todo = Todos::where('texte', 'Sortir le chien')->first();

        if ($todo) {
            $todo->users()->attach(1);
        }

        $todo = Todos::where('texte', 'Préparer la réunion de lundi')->first();

        if ($todo) {
            $todo->users()->attach(1);
        }
    }
}
