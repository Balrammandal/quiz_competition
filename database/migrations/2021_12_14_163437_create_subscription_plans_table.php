<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriptionPlansTable extends Migration {

	public function up()
	{
		Schema::create('subscription_plans', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->integer('validity')->nullable();
			$table->enum('validity_type', array('Days','Months', 'Year'))->default('Days');
			$table->float('price',8,2)->default(0.00);
			$table->enum('status', array('Active', 'Inactive'))->default('Active');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('subscription_plans');
	}
}