<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->text('title_en');
            $table->text('title_ar');
            $table->text('description_ar');
            $table->text('description_en');
            $table->text('body');
            $table->text('cover_en');
            $table->text('cover_ar');
            $table->text('url');
            $table->boolean('free'); // url or html
            $table->enum('status',['draft','published'])->default('draft');
            $table->enum('type',['book','poem']);
            $table->bigInteger('views'); // url or html
            $table->timestamps();
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('books', function(Blueprint $table)
		{
			//
            $table->drop();
		});
	}

}
