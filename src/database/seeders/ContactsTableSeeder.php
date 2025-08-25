<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ContactsTableSeeder extends Seeder
{


  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(): void
  {

    Schema::disableForeignKeyConstraints();
    Contact::truncate();
    Schema::enableForeignKeyConstraints();

    Contact::factory()->count(35)->create();
  }
}
