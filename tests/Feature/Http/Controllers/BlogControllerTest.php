<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Blog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BlogController
 */
final class BlogControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $blogs = Blog::factory()->count(3)->create();

        $response = $this->get(route('blogs.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BlogController::class,
            'store',
            \App\Http\Requests\BlogControllerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $title = $this->faker->sentence(4);
        $image = $this->faker->word();
        $start_date = Carbon::parse($this->faker->date());
        $details = $this->faker->text();

        $response = $this->post(route('blogs.store'), [
            'title' => $title,
            'image' => $image,
            'start_date' => $start_date->toDateString(),
            'details' => $details,
        ]);

        $blogs = Blog::query()
            ->where('title', $title)
            ->where('image', $image)
            ->where('start_date', $start_date)
            ->where('details', $details)
            ->get();
        $this->assertCount(1, $blogs);
        $blog = $blogs->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $blog = Blog::factory()->create();

        $response = $this->get(route('blogs.show', $blog));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BlogController::class,
            'update',
            \App\Http\Requests\BlogControllerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $blog = Blog::factory()->create();
        $title = $this->faker->sentence(4);
        $image = $this->faker->word();
        $start_date = Carbon::parse($this->faker->date());
        $details = $this->faker->text();

        $response = $this->put(route('blogs.update', $blog), [
            'title' => $title,
            'image' => $image,
            'start_date' => $start_date->toDateString(),
            'details' => $details,
        ]);

        $blog->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $blog->title);
        $this->assertEquals($image, $blog->image);
        $this->assertEquals($start_date, $blog->start_date);
        $this->assertEquals($details, $blog->details);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $blog = Blog::factory()->create();

        $response = $this->delete(route('blogs.destroy', $blog));

        $response->assertNoContent();

        $this->assertModelMissing($blog);
    }
}
