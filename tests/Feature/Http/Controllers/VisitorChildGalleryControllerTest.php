<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\VisitorChildGallery;
use App\Models\VisitorGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VisitorChildGalleryController
 */
final class VisitorChildGalleryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $visitorChildGalleries = VisitorChildGallery::factory()->count(3)->create();

        $response = $this->get(route('visitor-child-galleries.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VisitorChildGalleryController::class,
            'store',
            \App\Http\Requests\VisitorChildGalleryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $visitor_gallery = VisitorGallery::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->post(route('visitor-child-galleries.store'), [
            'visitor_gallery_id' => $visitor_gallery->id,
            'status' => $status,
        ]);

        $visitorChildGalleries = VisitorChildGallery::query()
            ->where('visitor_gallery_id', $visitor_gallery->id)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $visitorChildGalleries);
        $visitorChildGallery = $visitorChildGalleries->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $visitorChildGallery = VisitorChildGallery::factory()->create();

        $response = $this->get(route('visitor-child-galleries.show', $visitorChildGallery));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VisitorChildGalleryController::class,
            'update',
            \App\Http\Requests\VisitorChildGalleryUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $visitorChildGallery = VisitorChildGallery::factory()->create();
        $visitor_gallery = VisitorGallery::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->put(route('visitor-child-galleries.update', $visitorChildGallery), [
            'visitor_gallery_id' => $visitor_gallery->id,
            'status' => $status,
        ]);

        $visitorChildGallery->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($visitor_gallery->id, $visitorChildGallery->visitor_gallery_id);
        $this->assertEquals($status, $visitorChildGallery->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $visitorChildGallery = VisitorChildGallery::factory()->create();

        $response = $this->delete(route('visitor-child-galleries.destroy', $visitorChildGallery));

        $response->assertNoContent();

        $this->assertModelMissing($visitorChildGallery);
    }
}
