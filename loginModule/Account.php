<?php

/**
 * Manipulation With Account
 *
 * $account = new Account();
 * $account->logIn( string, string );
 *
 */


class Account
{
	public static function logIn( $userName, $password, $DB)
	{	
		$userWhereExpresion = "username = '" . $userName . "' AND password = '" . md5($password) . "'";

		$user = $DB->select(["*"])
				 ->from("users")
				 ->where($userWhereExpresion)
				 ->limit(1)
				 ->execute();

		if ( $user[0]['username'] == null ) {
			return false;
		}

		$_SESSION["userName"] =  $user[0]['username'];
		$_SESSION["name"] = $_SESSION["name"];
		$depositId= $DB->select( ['*'] )
		               ->from('mentenance')
		               ->where( "users_id = ". $user[0]['users_id'])
		               ->execute();


		$_SESSION['depozitId'] = $depositId[0]['depozit'];

		$role = $DB->select( ['*'] )
		            ->from('users_role')
		            ->where( "users_role_id = ". $user[0]['users_role_id'])
		            ->execute();
        $_SESSION["role"] = $role[0]['name'];
		return true;
	}

	public static function isLogIn()
	{
		if (  isset( $_SESSION["userName"] ) ) {
			return true;
		}

		return false;
	}

	public static function isNotLogIn()
	{
		if (  !isset( $_SESSION["userName"] ) ) {
			return true;
		}

		return false;
	}

	public static function logOut()
	{
		return session_unset();
	}

	public static function userName()
	{
		return $_SESSION["userName"];
	}

	public static function role()
	{
		return $_SESSION["role"];
	}
}

?>