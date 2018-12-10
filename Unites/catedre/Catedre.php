<?php


/**
 * For catedre manage
 */

 

class Catedre
{
	public function getAllCatedre( $DB )
	{
		$catedre = $DB->select( ["*"] )
				     ->from( "catedre" )
				     ->execute();

		return $catedre;
	}

	public function optionFromCatedreArray( $catedre )
	{
		$options = "";

		for ( $i = 0, $catedreCount = count($catedre); $i < $catedreCount; $i++ ) { 
			$options .= "<option value=" . $catedre[$i]['catedre_id'] . ">" .$catedre[$i]['name'] ."</option>";
		}

		return $options;
	}

	public function getCatedreByIdAsJSON( $id, $DB )
	{
		$catedra = $this->getCatedreById( $id, $DB );

		$catedraAsArray = [];

		foreach ($catedra as $field => $value) {
			 $catedraAsArray[] = '"' . $field . '"' . ':' . '"' . $value . '"';
		}

		$catedraJSON = '{' . implode(',', $catedraAsArray) . '}';
		return $catedraJSON;

	}

	public function getCatedreById( $id, $DB )
	{
		$catedra = $DB->select( ["*"] )
				     ->from("catedre")
				     ->where( "catedre_id = " . $id )
				     ->limit( 1 )
				     ->execute();

		return $catedra[0];
	}

	public function getAllCatedreAsOptions( $DB )
	{
		$catedre = $this->getAllCatedre( $DB );

		return $this->optionFromCatedreArray( $catedre );
	}

	public function insert( $values, $DB )
	{
		$DB->insert( 'catedre', ["name "] )
		   ->values( $values )
		   ->execute();
	}
}