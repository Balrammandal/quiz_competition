<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersSubscriptionsTable extends Migration {

	public function up()
	{
		Schema::create('users_subscriptions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->integer('subscription_id')->unsigned()->index();
			$table->json('subscription_details')->nullable();
			$table->date('purchase_date')->nullable();
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->float('total_price',8,2)->default(0.00);
			$table->enum('payment_status', array('Pending', 'Completed', 'Failed'))->default('Pending');
			$table->string('txn_id')->nullable();
			$table->enum('status', array('Active', 'Expired', 'Canceled'))->default('Active');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users_subscriptions');
	}
}