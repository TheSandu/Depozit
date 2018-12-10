<?php


/**
 * For birouri manage
 */

 

class Birouri
{
	public function getAllBirouri( $DB )
	{
		$birouri = $DB->select(["*"])
				     ->from("birouri")
				     ->execute();

		return $birouri;
	}

	public function optionFromBirouriArray( $birouri )
	{
		$options = "";

		for ($i = 0, $birouriCount = count($birouri); $i < $birouriCount; $i++) { 
			$options .= "<option value=" . $birouri[$i]['birouri_id'] . ">" .$birouri[$i]['name'] ."</option>";
		}

		return $options;
	}

	public function getAllBirouriAsOptions( $DB )
	{
		$birouri = $this->getAllBirouri( $DB );

		return $this->optionFromBirouriArray( $birouri );
	}

	public function insert( $values, $DB )
	{
		$DB->insert( 'birouri', ["name"] )
		   ->values( $values )
		   ->execute();
	}
}