<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration {

	public function up()
	{
		Schema::create('groups', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('teacher_id')->unsigned();
			$table->string('name')->nullable();
			$table->enum('status', array('Active', 'Inactive'))->default('Active');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('groups');
	}
}