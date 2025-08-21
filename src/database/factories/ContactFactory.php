<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */

  protected $model = Contact::class;

  public function definition()
  {
    return [
      'first_name' => $this->faker->firstName(),
      'last_name' => $this->faker->lastName(),
      'gender' => $this->faker->randomElement(['1', '2', '3']),
      'email' => $this->faker->unique()->safeEmail(),
      'tel' => $this->faker->phoneNumber(),
      'address' => preg_replace('/[0-9]/','',$this->faker->address()),
      'building' => $this->faker->secondaryAddress(),
      'detail' => $this->faker->realText()
    ];
  }
}
