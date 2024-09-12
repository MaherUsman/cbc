<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ContactU;
use App\Models\ContactUs;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ContactUsController
 */
final class ContactUsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $contactUs = ContactUs::factory()->count(3)->create();

        $response = $this->get(route('contact-us.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_behaves_as_expected(): void
    {
        $response = $this->post(route('contact-us.store'));
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $contactU = ContactUs::factory()->create();

        $response = $this->get(route('contact-us.show', $contactU));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ContactUsController::class,
            'update',
            \App\Http\Requests\ContactUsUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $contactU = ContactUs::factory()->create();
        $full_name = $this->faker->word();
        $email = $this->faker->safeEmail();
        $phone_number = $this->faker->phoneNumber();
        $subject = $this->faker->word();
        $details = $this->faker->text();

        $response = $this->put(route('contact-us.update', $contactU), [
            'full_name' => $full_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'subject' => $subject,
            'details' => $details,
        ]);

        $contactU->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($full_name, $contactU->full_name);
        $this->assertEquals($email, $contactU->email);
        $this->assertEquals($phone_number, $contactU->phone_number);
        $this->assertEquals($subject, $contactU->subject);
        $this->assertEquals($details, $contactU->details);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $contactU = ContactUs::factory()->create();
        $contactU = ContactU::factory()->create();

        $response = $this->delete(route('contact-us.destroy', $contactU));

        $response->assertNoContent();

        $this->assertModelMissing($contactU);
    }
}
