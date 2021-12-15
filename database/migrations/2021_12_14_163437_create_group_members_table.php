<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupMembersTable extends Migration {

	public function up()
	{
		Schema::create('group_members', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('group_id')->unsigned()->index();
			$table->string('name')->nullable();
			$table->string('points')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('group_members');
	}
}