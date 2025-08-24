<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
  protected $model = Contact::class;

  public function definition(): array
  {
    $kinds = [
      '商品のお届けについて',
      '商品の交換について',
      '商品トラブル',
      'ショップへのお問い合わせ',
      'その他',
    ];
    $kind = $this->faker->randomElement($kinds);
    $categoryId = Category::where('content', $kind)->value('id');

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
      'kind'        => $kind,
      'category_id' => $categoryId,
      'detail'      => $this->faker->realText(60),
    ];
  }
}
