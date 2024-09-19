<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\AboutUsGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AboutUsGalleryController
 */
final class AboutUsGalleryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $aboutUsGalleries = AboutUsGallery::factory()->count(3)->create();

        $response = $this->get(route('about-us-galleries.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AboutUsGalleryController::class,
            'store',
            \App\Http\Requests\AboutUsGalleryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = $this->faker->boolean();

        $response = $this->post(route('about-us-galleries.store'), [
            'status' => $status,
        ]);

        $aboutUsGalleries = AboutUsGallery::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $aboutUsGalleries);
        $aboutUsGallery = $aboutUsGalleries->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $aboutUsGallery = AboutUsGallery::factory()->create();

        $response = $this->get(route('about-us-galleries.show', $aboutUsGallery));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AboutUsGalleryController::class,
            'update',
            \App\Http\Requests\AboutUsGalleryUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $aboutUsGallery = AboutUsGallery::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->put(route('about-us-galleries.update', $aboutUsGallery), [
            'status' => $status,
        ]);

        $aboutUsGallery->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $aboutUsGallery->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $aboutUsGallery = AboutUsGallery::factory()->create();

        $response = $this->delete(route('about-us-galleries.destroy', $aboutUsGallery));

        $response->assertNoContent();

        $this->assertModelMissing($aboutUsGallery);
    }
}
