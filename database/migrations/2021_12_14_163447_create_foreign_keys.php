<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users_subscriptions', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('users_subscriptions', function(Blueprint $table) {
			$table->foreign('subscription_id')->references('id')->on('subscription_plans')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('groups', function(Blueprint $table) {
			$table->foreign('teacher_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('group_members', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('questions', function(Blueprint $table) {
			$table->foreign('level_id')->references('id')->on('levels')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('group_questions', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('group_questions', function(Blueprint $table) {
			$table->foreign('question_id')->references('id')->on('questions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('group_questions', function(Blueprint $table) {
			$table->foreign('group_member_id')->references('id')->on('group_members')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('users_subscriptions', function(Blueprint $table) {
			$table->dropForeign('users_subscriptions_user_id_foreign');
		});
		Schema::table('users_subscriptions', function(Blueprint $table) {
			$table->dropForeign('users_subscriptions_subscription_id_foreign');
		});
		Schema::table('groups', function(Blueprint $table) {
			$table->dropForeign('groups_teacher_id_foreign');
		});
		Schema::table('group_members', function(Blueprint $table) {
			$table->dropForeign('group_members_group_id_foreign');
		});
		Schema::table('questions', function(Blueprint $table) {
			$table->dropForeign('questions_level_id_foreign');
		});
		Schema::table('group_questions', function(Blueprint $table) {
			$table->dropForeign('group_questions_group_id_foreign');
		});
		Schema::table('group_questions', function(Blueprint $table) {
			$table->dropForeign('group_questions_question_id_foreign');
		});
		Schema::table('group_questions', function(Blueprint $table) {
			$table->dropForeign('group_questions_group_member_id_foreign');
		});
	}
}