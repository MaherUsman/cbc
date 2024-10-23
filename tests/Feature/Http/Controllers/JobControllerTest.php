<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\JobController
 */
final class JobControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $jobs = Job::factory()->count(3)->create();

        $response = $this->get(route('jobs.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JobController::class,
            'store',
            \App\Http\Requests\JobStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $status = $this->faker->boolean();

        $response = $this->post(route('jobs.store'), [
            'status' => $status,
        ]);

        $jobs = Job::query()
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $jobs);
        $job = $jobs->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $job = Job::factory()->create();

        $response = $this->get(route('jobs.show', $job));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\JobController::class,
            'update',
            \App\Http\Requests\JobUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $job = Job::factory()->create();
        $status = $this->faker->boolean();

        $response = $this->put(route('jobs.update', $job), [
            'status' => $status,
        ]);

        $job->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($status, $job->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $job = Job::factory()->create();

        $response = $this->delete(route('jobs.destroy', $job));

        $response->assertNoContent();

        $this->assertModelMissing($job);
    }
}
