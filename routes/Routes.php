<?php

/**
 * Used to make redirections
 */
 
class Routes
{

	public static function toAdminPage()
	{
		header("Location: /adminPanel/admin.php");die();
	}

	public static function toLoginPage()
	{
		header("Location: /loginModule/login.php");die();
	}

	public function toManagerPage()
	{
		header("Location: /managerModule/manager.php");die();
	}
}