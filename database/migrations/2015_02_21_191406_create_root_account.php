<?php

use Domain\Model\User;
use Illuminate\Database\Migrations\Migration;

class CreateRootAccount extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$rootAccount = new User();

		$rootAccount->name = 'root';
		$rootAccount->email = 'root@triga.dev';
		$rootAccount->password = bcrypt('triga');

		$rootAccount->save();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		User::where('email', '=', 'root@triga.dev')->delete();
	}

}
