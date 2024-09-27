<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ActivityGallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ActivityGalleryController
 */
final class ActivityGalleryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $activityGalleries = ActivityGallery::factory()->count(3)->create();

        $response = $this->get(route('activity-galleries.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ActivityGalleryController::class,
            'store',
            \App\Http\Requests\ActivityGalleryStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = $this->faker->boolean();

        $response = $this->post(route('activity-galleries.store'), [
            'status' => $status,
        ]);

        $activityGalleries = ActivityGallery::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $activityGalleries);
        $activityGallery = $activityGalleries->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $activityGallery = ActivityGallery::factory()->create();

        $response = $this->get(route('activity-galleries.show', $activityGallery));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ActivityGalleryController::class,
            'update',
            \App\Http\Requests\ActivityGalleryUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $activityGallery = ActivityGallery::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->put(route('activity-galleries.update', $activityGallery), [
            'status' => $status,
        ]);

        $activityGallery->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $activityGallery->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $activityGallery = ActivityGallery::factory()->create();

        $response = $this->delete(route('activity-galleries.destroy', $activityGallery));

        $response->assertNoContent();

        $this->assertModelMissing($activityGallery);
    }
}
