<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TeamController
 */
final class TeamControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $teams = Team::factory()->count(3)->create();

        $response = $this->get(route('teams.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TeamController::class,
            'store',
            \App\Http\Requests\TeamStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $response = $this->post(route('teams.store'));

        $response->assertCreated();
        $response->assertJsonStructure([]);

        $this->assertDatabaseHas(teams, [ /* ... */ ]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $team = Team::factory()->create();

        $response = $this->get(route('teams.show', $team));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TeamController::class,
            'update',
            \App\Http\Requests\TeamUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $team = Team::factory()->create();

        $response = $this->put(route('teams.update', $team));

        $team->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $team = Team::factory()->create();

        $response = $this->delete(route('teams.destroy', $team));

        $response->assertNoContent();

        $this->assertModelMissing($team);
    }
}
