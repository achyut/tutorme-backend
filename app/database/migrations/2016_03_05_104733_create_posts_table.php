<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('shortdesc');
			$table->text('longdesc');
			$table->double('price');
			$table->double('rating');
			$table->datetime('startdate');
			$table->datetime('enddate');
			$table->datetime('starttime');
			$table->datetime('endtime');
			$table->string('address');
			$table->string('contact');
			$table->string('email');
			$table->string('preferedcontact');
			
			$table->integer('category')->unsigned();
			$table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
			
			$table->integer('subcategory')->unsigned();
			$table->foreign('subcategory')->references('id')->on('subcategories')->onDelete('cascade');
			
			$table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

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
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::drop('posts');
	}

}
