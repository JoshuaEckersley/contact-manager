<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'DOB' => $this->faker->date,
            'company_name' => $this->faker->company,
            'position' => $this->faker->jobTitle,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Contact $contact) {
            // Create the mandatory first phone number.
            PhoneNumber::factory()->make(['contact_id' => $contact->id])->save();
        });
    }}
