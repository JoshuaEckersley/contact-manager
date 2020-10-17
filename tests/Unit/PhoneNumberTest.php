<?php

namespace Tests\Unit;

use App\Models\PhoneNumber;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhoneNumberTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCanSavePhoneNumber()
    {
        $number = '0411111111';

        $phoneNumber = new PhoneNumber();
        $contact = Contact::factory()->create();
        $phoneNumber->number = $number;
        $phoneNumber->contact()->associate($contact);
        $phoneNumber->save();

        $this->assertDatabaseHas('phone_numbers', [
            'number' => $number,
        ]);
    }
}
