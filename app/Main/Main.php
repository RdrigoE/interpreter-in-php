<?php

namespace App\Main;

use App\REPL\REPL;

class Main
{
	public static function run()
	{
		echo ("Hello! This is the Monkey programming language!\n");
		echo ("Feel free to type in commands\n");
		REPL::start();
	}
}