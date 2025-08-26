<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
  protected $model = Contact::class;

  public function definition(): array
  {
    $category_id = $this->faker->numberBetween(1, 5);
    $head = $this->faker->randomElement(['080', '090', '070']);
    $tel  = $head . $this->faker->numerify('########');

    return [
      'first_name'  => $this->faker->firstName(),
      'last_name'   => $this->faker->lastName(),
      'gender'      => $this->faker->randomElement([1, 2, 3]),
      'email'       => $this->faker->unique()->safeEmail(),
      'tel'         => $tel,
      'address'     => $this->faker->address(),
      'building'    => $this->faker->secondaryAddress(),
      'category_id' => $category_id,
      'detail'      => $this->faker->realText(60),
    ];
  }
}
