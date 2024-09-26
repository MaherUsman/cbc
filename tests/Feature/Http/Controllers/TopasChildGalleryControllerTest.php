<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TopasChildGallery;
use App\Models\TopasGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TopasChildGalleryController
 */
final class TopasChildGalleryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $topasChildGalleries = TopasChildGallery::factory()->count(3)->create();

        $response = $this->get(route('topas-child-galleries.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TopasChildGalleryController::class,
            'store',
            \App\Http\Requests\TopasChildGalleryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $topas_gallery = TopasGallery::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->post(route('topas-child-galleries.store'), [
            'topas_gallery_id' => $topas_gallery->id,
            'status' => $status,
        ]);

        $topasChildGalleries = TopasChildGallery::query()
            ->where('topas_gallery_id', $topas_gallery->id)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $topasChildGalleries);
        $topasChildGallery = $topasChildGalleries->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $topasChildGallery = TopasChildGallery::factory()->create();

        $response = $this->get(route('topas-child-galleries.show', $topasChildGallery));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TopasChildGalleryController::class,
            'update',
            \App\Http\Requests\TopasChildGalleryUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $topasChildGallery = TopasChildGallery::factory()->create();
        $topas_gallery = TopasGallery::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->put(route('topas-child-galleries.update', $topasChildGallery), [
            'topas_gallery_id' => $topas_gallery->id,
            'status' => $status,
        ]);

        $topasChildGallery->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($topas_gallery->id, $topasChildGallery->topas_gallery_id);
        $this->assertEquals($status, $topasChildGallery->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $topasChildGallery = TopasChildGallery::factory()->create();

        $response = $this->delete(route('topas-child-galleries.destroy', $topasChildGallery));

        $response->assertNoContent();

        $this->assertModelMissing($topasChildGallery);
    }
}
