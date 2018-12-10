<?php


/**
 * For types manage
 */
 
class Types
{
	public function getAllTypes( $DB )
	{
		$types = $DB->select(["*"])
				     ->from("tipuri")
				     ->execute();

		return $types;
	}

	public function optionFromTypesArray( $types )
	{
		$options = "";

		for ($i = 0, $typesCount = count($types); $i < $typesCount; $i++) { 
			$options .= "<option value=" . $types[$i]['tipuri_id'] . ">" .$types[$i]['name'] ."</option>";
		}

		return $options;
	}

	public function getAllTypesAsOptions( $DB )
	{
		$types = $this->getAllTypes( $DB );

		return $this->optionFromTypesArray( $types );
	}

	public function insert( $values, $DB )
	{
		$DB->insert( 'tipuri', ["name"] )
		   ->values( $values )
		   ->execute();

	}
}