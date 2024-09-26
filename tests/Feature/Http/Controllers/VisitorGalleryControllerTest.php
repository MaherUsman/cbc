<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\VisitorGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VisitorGalleryController
 */
final class VisitorGalleryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $visitorGalleries = VisitorGallery::factory()->count(3)->create();

        $response = $this->get(route('visitor-galleries.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VisitorGalleryController::class,
            'store',
            \App\Http\Requests\VisitorGalleryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = $this->faker->boolean();

        $response = $this->post(route('visitor-galleries.store'), [
            'status' => $status,
        ]);

        $visitorGalleries = VisitorGallery::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $visitorGalleries);
        $visitorGallery = $visitorGalleries->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $visitorGallery = VisitorGallery::factory()->create();

        $response = $this->get(route('visitor-galleries.show', $visitorGallery));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VisitorGalleryController::class,
            'update',
            \App\Http\Requests\VisitorGalleryUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $visitorGallery = VisitorGallery::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->put(route('visitor-galleries.update', $visitorGallery), [
            'status' => $status,
        ]);

        $visitorGallery->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $visitorGallery->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $visitorGallery = VisitorGallery::factory()->create();

        $response = $this->delete(route('visitor-galleries.destroy', $visitorGallery));

        $response->assertNoContent();

        $this->assertModelMissing($visitorGallery);
    }
}
