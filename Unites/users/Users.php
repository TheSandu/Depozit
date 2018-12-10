<?php


/**
 * For user management
 */
class Users
{
	public function getAllUsers( $DB )
	{
		$users = $DB->select(["*"])
				     ->from("users")
				     ->execute();

		return $users;
	}

	public function optionFromUsersArray( $users )
	{
		$options = "";

		for ($i = 0, $usersCount = count($users); $i < $usersCount; $i++) { 
			$options .= "<option value=" . $users[$i]['users_id'] . ">" .$users[$i]['username'] ."</option>";
		}

		return $options;
	}

	public function getAllUsersAsOptions( $DB )
	{
		$users = $this->getAllUsers( $DB );

		return $this->optionFromUsersArray( $users );
	}

	public function insert( $values, $DB )
	{
		$DB->insert( 'users', ["username", "password", "role"] )
		   ->values( $values )
		   ->execute();
	}
}