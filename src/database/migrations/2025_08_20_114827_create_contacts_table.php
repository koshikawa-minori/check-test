<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('contacts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
      /*->nullable()→ 「カテゴリ未選択でも保存できる」ようにする。
      ->constrained()→ 自動で categories テーブルの id カラムを参照する外部キー制約をつける。
      ->cascadeOnDelete()→ 「親(categories)が消されたら子(contacts)も一緒に消す」カスケード削除ルールをつける。*/
      $table->string('first_name');
      $table->string('last_name');
      $table->tinyInteger('gender')->unsigned()->default(1);
      /* tinyInteger('gender')→unsigned 付きなので 0〜255。
      ->unsigned()→ マイナス値を禁止（0以上の整数に限定）
      ->default(1)→ デフォルト値は 1（＝未指定なら「男性」）
      */
      $table->string('email');
      $table->string('tel');
      $table->string('address');
      $table->string('building');
      /* $table->string('building')->nullable();
      じゃないとNOTNULLになっちゃう */
      $table->text('detail');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('contacts');
  }
}
