<?php

namespace Tests\Feature;

use App\Models\Todos;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodosSuppressionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: suppression d'une todo terminée avec succès
     */
    public function test_suppression_todo_terminee(): void
    {
        $user = User::factory()->create();
        $todo = Todos::factory()->create([
            'user_id' => $user->id,
            'termine' => true,  // La tâche est terminée
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('todo.delete', ['id' => $todo->id]));

        $response->assertRedirect(route('todo.liste'));

        // Vérifier que la todo a bien été supprimée
        $this->assertDatabaseMissing('todos', [
            'id' => $todo->id,
        ]);
    }

    /**
     * Test: impossible de supprimer une todo non terminée
     */
    public function test_impossible_supprimer_todo_non_terminee(): void
    {
        $user = User::factory()->create();
        $todo = Todos::factory()->create([
            'user_id' => $user->id,
            'termine' => false,  // La tâche n'est pas terminée
        ]);

        $response = $this
            ->actingAs($user)
            ->delete(route('todo.delete', ['id' => $todo->id]));

        $response
            ->assertRedirect(route('todo.liste'))
            ->assertSessionHas('message', 'Veuillez terminé la tache avant de la supprimé');

        // Vérifier que la todo existe toujours
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
        ]);
    }

    /**
     * Test: seul un utilisateur authentifié peut supprimer une todo
     */
    public function test_suppression_requiert_authentification(): void
    {
        $todo = Todos::factory()->create([
            'termine' => true,
        ]);

        $response = $this->delete(route('todo.delete', ['id' => $todo->id]));

        // Doit être redirigé vers la page de login
        $response->assertRedirect('/login');

        // Vérifier que la todo existe toujours
        $this->assertDatabaseHas('todos', [
            'id' => $todo->id,
        ]);
    }
}
