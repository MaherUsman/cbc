<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Slider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SliderController
 */
final class SliderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $sliders = Slider::factory()->count(3)->create();

        $response = $this->get(route('sliders.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SliderController::class,
            'store',
            \App\Http\Requests\SliderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $display_order = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->boolean();

        $response = $this->post(route('sliders.store'), [
            'display_order' => $display_order,
            'status' => $status,
        ]);

        $sliders = Slider::query()
            ->where('display_order', $display_order)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $sliders);
        $slider = $sliders->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $slider = Slider::factory()->create();

        $response = $this->get(route('sliders.show', $slider));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SliderController::class,
            'update',
            \App\Http\Requests\SliderUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $slider = Slider::factory()->create();
        $display_order = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->boolean();

        $response = $this->put(route('sliders.update', $slider), [
            'display_order' => $display_order,
            'status' => $status,
        ]);

        $slider->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($display_order, $slider->display_order);
        $this->assertEquals($status, $slider->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $slider = Slider::factory()->create();

        $response = $this->delete(route('sliders.destroy', $slider));

        $response->assertNoContent();

        $this->assertModelMissing($slider);
    }
}
