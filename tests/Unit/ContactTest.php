<?php

namespace Tests\Unit;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCanSaveContact()
    {
        Model::unguard();

        $input = [
            'first_name' => 'Roger',
            'last_name' => 'Federer',
            'DOB' => '1980-01-01',
            'company_name' => 'UNIQLO',
            'position' => 'ATP Tour Player',
            'email' => 'someemail@example.com',
        ];

        $contact = new Contact();
        $contact->fill($input);
        $contact->save();

        $this->assertDatabaseHas('contacts', $input);
    }

    public function testOptionalFields()
    {
        Model::unguard();

        $input = [
            'first_name' => 'Roger',
            'last_name' => 'Federer',
            //'DOB' => '1980-01-01',
            'company_name' => 'UNIQLO',
            'position' => 'ATP Tour Player',
            //'email' => 'someemail@example.com',
        ];

        $contact = new Contact();
        $contact->fill($input);
        $contact->save();

        $this->assertDatabaseHas('contacts', $input);
    }

    public function testRequiredFields()
    {
        Model::unguard();

        $input = [
            //'first_name' => 'Roger',
            //'last_name' => 'Federer',
            'DOB' => '1980-01-01',
            //'company_name' => 'UNIQLO',
            //'position' => 'ATP Tour Player',
            'email' => 'someemail@example.com',
        ];

        $contact = new Contact();
        $contact->fill($input);

        $this->expectException(\Illuminate\Database\QueryException::class);
        $contact->save();
    }
}
