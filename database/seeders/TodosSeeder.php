<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        $todos = [
            'Faire les courses',
            'Arroser les plantes',
            'Répondre aux e-mails',
            'Nettoyer la cuisine',
            'Sortir le chien',
            'Préparer la réunion de lundi',
        ];

        $data = [];

        foreach ($todos as $texte) {
            // Générer une date aléatoire dans les 10 prochains jours ou null
            // Certaines todos auront une date, d'autres non
            $due_date = rand(0, 1) ? Carbon::now()->addDays(rand(1, 10)) : null;

            $data[] = [
                'texte' => $texte,
                'termine' => rand(0, 1),
                'important' => rand(0, 1),
                'due_date' => $due_date ? $due_date->format('Y-m-d H:i:s') : null,
                'user_id' => $user->id, // Associer toutes les todos à l'utilisateur avec ID 1
            ];
        }
        // $data = [
        //        ['texte' => 'texte', 'termine' => 0,'important' => 0],
        //        ['texte' => 'texte 2', 'termine' => 0,'important' => 0]
        //    ];

        DB::table('todos')->insert($data);
    }
}
