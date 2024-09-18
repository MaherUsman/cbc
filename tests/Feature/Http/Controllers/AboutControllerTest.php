<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\About;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AboutController
 */
final class AboutControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $abouts = About::factory()->count(3)->create();

        $response = $this->get(route('abouts.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AboutController::class,
            'store',
            \App\Http\Requests\AboutStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $display_order = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->boolean();

        $response = $this->post(route('abouts.store'), [
            'display_order' => $display_order,
            'status' => $status,
        ]);

        $abouts = About::query()
            ->where('display_order', $display_order)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $abouts);
        $about = $abouts->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $about = About::factory()->create();

        $response = $this->get(route('abouts.show', $about));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AboutController::class,
            'update',
            \App\Http\Requests\AboutUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $about = About::factory()->create();
        $display_order = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->boolean();

        $response = $this->put(route('abouts.update', $about), [
            'display_order' => $display_order,
            'status' => $status,
        ]);

        $about->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($display_order, $about->display_order);
        $this->assertEquals($status, $about->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $about = About::factory()->create();

        $response = $this->delete(route('abouts.destroy', $about));

        $response->assertNoContent();

        $this->assertModelMissing($about);
    }
}
