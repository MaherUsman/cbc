<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\AboutU;
use App\Models\AboutUs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AboutUsController
 */
final class AboutUsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $aboutUs = AboutUs::factory()->count(3)->create();

        $response = $this->get(route('about-us.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AboutUsController::class,
            'store',
            \App\Http\Requests\AboutUsStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = $this->faker->boolean();

        $response = $this->post(route('about-us.store'), [
            'status' => $status,
        ]);

        $aboutUs = AboutU::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $aboutUs);
        $aboutU = $aboutUs->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $aboutU = AboutUs::factory()->create();

        $response = $this->get(route('about-us.show', $aboutU));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AboutUsController::class,
            'update',
            \App\Http\Requests\AboutUsUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $aboutU = AboutUs::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->put(route('about-us.update', $aboutU), [
            'status' => $status,
        ]);

        $aboutU->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $aboutU->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $aboutU = AboutUs::factory()->create();
        $aboutU = AboutU::factory()->create();

        $response = $this->delete(route('about-us.destroy', $aboutU));

        $response->assertNoContent();

        $this->assertModelMissing($aboutU);
    }
}
