<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('questions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('level_id')->unsigned();
			$table->longText('questions')->nullable();
			$table->json('answers')->nullable();
			$table->longText('currect_answer')->nullable();
			$table->enum('status', array('Active', 'Inactive'))->default('Active');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('questions');
	}
}