<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Animal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AnimalController
 */
final class AnimalControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $animals = Animal::factory()->count(3)->create();

        $response = $this->get(route('animals.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AnimalController::class,
            'store',
            \App\Http\Requests\AnimalStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $show_on_top_bar = $this->faker->boolean();
        $status = $this->faker->boolean();
        $display_order = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('animals.store'), [
            'show_on_top_bar' => $show_on_top_bar,
            'status' => $status,
            'display_order' => $display_order,
        ]);

        $animals = Animal::query()
            ->where('show_on_top_bar', $show_on_top_bar)
            ->where('status', $status)
            ->where('display_order', $display_order)
            ->get();
        $this->assertCount(1, $animals);
        $animal = $animals->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $animal = Animal::factory()->create();

        $response = $this->get(route('animals.show', $animal));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AnimalController::class,
            'update',
            \App\Http\Requests\AnimalUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $animal = Animal::factory()->create();
        $show_on_top_bar = $this->faker->boolean();
        $status = $this->faker->boolean();
        $display_order = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('animals.update', $animal), [
            'show_on_top_bar' => $show_on_top_bar,
            'status' => $status,
            'display_order' => $display_order,
        ]);

        $animal->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($show_on_top_bar, $animal->show_on_top_bar);
        $this->assertEquals($status, $animal->status);
        $this->assertEquals($display_order, $animal->display_order);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $animal = Animal::factory()->create();

        $response = $this->delete(route('animals.destroy', $animal));

        $response->assertNoContent();

        $this->assertModelMissing($animal);
    }
}
