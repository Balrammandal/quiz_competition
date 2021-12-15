<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('group_questions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('group_id')->unsigned();
			$table->integer('question_id')->unsigned()->index();
			$table->string('points')->nullable();
			$table->integer('group_member_id')->unsigned();
			$table->enum('status', array('Pending', 'Completed'))->default('Pending');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('group_questions');
	}
}