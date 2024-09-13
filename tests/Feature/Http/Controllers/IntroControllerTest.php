<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Intro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\IntroController
 */
final class IntroControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $intros = Intro::factory()->count(3)->create();

        $response = $this->get(route('intros.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\IntroController::class,
            'store',
            \App\Http\Requests\IntroStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = $this->faker->boolean();

        $response = $this->post(route('intros.store'), [
            'status' => $status,
        ]);

        $intros = Intro::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $intros);
        $intro = $intros->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $intro = Intro::factory()->create();

        $response = $this->get(route('intros.show', $intro));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\IntroController::class,
            'update',
            \App\Http\Requests\IntroUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $intro = Intro::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->put(route('intros.update', $intro), [
            'status' => $status,
        ]);

        $intro->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $intro->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $intro = Intro::factory()->create();

        $response = $this->delete(route('intros.destroy', $intro));

        $response->assertNoContent();

        $this->assertModelMissing($intro);
    }
}
