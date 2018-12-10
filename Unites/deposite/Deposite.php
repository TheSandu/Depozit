<?php


/**
 * For deposite manage
 * Usage
 *   $Deposit = new Deposite();
 * 	 array[obj] = $Deposit->getAllDeposite( class[DB] );
 *   string[<options>] = $Deposit->getAllDepositeAsOptions( class[DB] );
 */

class Depozite
{
	public function getAllDeposite( $DB )
	{
		$deposite = $DB->select(["*"])
				     ->from("depozite")
				     ->execute();

		return $deposite;
	}

	private function optionFromDepositeArray( $deposite )
	{
		$options = "";
		for ( $i = 0, $depositeCount = count($deposite); $i < $depositeCount; $i++ ) { 
			$options .= "<option value=" . $deposite[$i]['depozite_id'] . ">" .$deposite[$i]['name'] ."</option>";
		}

		return $options;
	}

	public function getAllDepositeAsOptions( $DB )
	{
		$deposite = $this->getAllDeposite( $DB );
		return $this->optionFromDepositeArray( $deposite );
	}

	public function insert( $values, $DB )
	{
		$DB->insert( 'depozite', ["name"] )
		   ->values( $values )
		   ->execute();
	}
}