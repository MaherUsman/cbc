<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TopasGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TopasGalleryController
 */
final class TopasGalleryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $topasGalleries = TopasGallery::factory()->count(3)->create();

        $response = $this->get(route('topas-galleries.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TopasGalleryController::class,
            'store',
            \App\Http\Requests\TopasGalleryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = $this->faker->boolean();

        $response = $this->post(route('topas-galleries.store'), [
            'status' => $status,
        ]);

        $topasGalleries = TopasGallery::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $topasGalleries);
        $topasGallery = $topasGalleries->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $topasGallery = TopasGallery::factory()->create();

        $response = $this->get(route('topas-galleries.show', $topasGallery));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TopasGalleryController::class,
            'update',
            \App\Http\Requests\TopasGalleryUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $topasGallery = TopasGallery::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->put(route('topas-galleries.update', $topasGallery), [
            'status' => $status,
        ]);

        $topasGallery->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $topasGallery->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $topasGallery = TopasGallery::factory()->create();

        $response = $this->delete(route('topas-galleries.destroy', $topasGallery));

        $response->assertNoContent();

        $this->assertModelMissing($topasGallery);
    }
}
