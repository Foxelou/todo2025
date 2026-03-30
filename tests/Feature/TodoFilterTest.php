<?php

namespace Tests\Feature;

use App\Models\Todos;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoFilterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Vérifie que les boutons de filtre (Toutes, En cours, Terminées) sont bien affichés.
     */
    public function test_les_filtres_sont_presents_sur_la_page_accueil()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee('Toutes');
        $response->assertSee('En cours');
        $response->assertSee('Terminées');
    }

    /**
     * Vérifie que les tâches avec différents statuts sont bien chargées
     * et que les directives Alpine.js pour le filtrage sont présentes.
     */
    public function test_les_taches_sont_affichees_et_peuvent_etre_filtrees_reactivement()
    {
        $user = User::factory()->create();

        $todoEnCours = Todos::create([
            'texte' => 'Tâche en cours',
            'termine' => 0,
            'user_id' => $user->id,
        ]);

        $todoTerminee = Todos::create([
            'texte' => 'Tâche terminée',
            'termine' => 1,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee('Tâche en cours');
        $response->assertSee('Tâche terminée');

        // On vérifie que les éléments Alpine.js sont là
        $response->assertSee('x-data');
        $response->assertSee('x-show');
    }
}
