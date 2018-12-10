<?php



/**
 * For models manage
 *
 * Usage
 *   $Model = new Models();
 *
 * 	 array[obj] = $Model->getAllModels( class[DB] );
 *	 array[obj] = $Model->getAllModelsByType( string{ type[id] || type[name] }, class[DB] );
 *
 *   string[<options>] = $Model->getAllModelsAsOptions( class[DB] );
 *   string[<options>] = $Model->getAllModelsByTypeAsOptions( string{ type[id] || type[name] }, class[DB] );
 *
 */

 


class Models
{
	public function getAllModels( $DB )
	{
		$models = $DB->select(["*"])
				     ->from("materiale")
				     ->execute();

		return $models;
	}

	private function optionFromModelsArray( $models )
	{
		$options = "";

		for ($i = 0, $modelsCount = count($models); $i < $modelsCount; $i++) { 
			$options .= "<option value=" . $models[$i]['materiale_id'] . ">" . $models[$i]['anul'] ." ". $models[$i]['name'] ."</option>";
		}

		return $options;
	}

	private function tableFromModelsArray( $models )
	{
		$table = "<table class=table>";
		$table .="<tr>";
		$table .= "<th>name</th>";
		$table .= "<th>anul</th>";
		$table .= "<th>price</th>";
		$table .= "<th>stoc</th>";
		$table .= "<th>amount</th>";
		$table .= "<th>series</th>";
		$table .= "<th>nr_invoice</th>";
		$table .= "<th>ziua</th>";
		$table .= "<th>masura</th>";
		$table .="</tr>";


		for ($i = 0, $modelsCount = count($models); $i < $modelsCount; $i++) { 

			$table .= "<tr>";

			$table .= "<td>" . $models[$i]['name'] . "</td>";
			$table .= "<td>" . $models[$i]['anul'] . "</td>";
			$table .= "<td>" . $models[$i]['price'] . "</td>";
			$table .= "<td>" . $models[$i]['stoc'] . "</td>";
			$table .= "<td>" . $models[$i]['amount'] . "</td>";
			$table .= "<td>" . $models[$i]['series'] . "</td>";
			$table .= "<td>" . $models[$i]['nr_invoice'] . "</td>";
			$table .= "<td>" . $models[$i]['ziua'] . "</td>";
			$table .= "<td>" . $models[$i]['masura'] . "</td>";

			$table .= "</tr>";
		}

		$table .= "</table>";

		return $table;
	}

	public function getAllModelsByType( $typeId, $DB )
	{
		$models = $DB->select( ["*"] )
				     ->from("materiale")
				     ->where( "tuprui_id = " . $typeId )
				     ->execute();

		return $models;	
	}

	public function getModelsInStoc( $DB )
	{
		$models = $DB->select( ["*"] )
				     ->from( "materiale" )
				     ->where( "stoc > 0" )
				     ->execute();

		return $models;
	}


	public function getModelsInStocAsTable( $DB )
	{
		$models = $this->getModelsInStoc( $DB );

		return $this->tableFromModelsArray( $models );
	}

	public function getModelByIdAsJSON( $id, $DB )
	{
		$model = $this->getModelById( $id, $DB );

		$modelAsArray = [];

		foreach ($model as $field => $value) {
			 $modelAsArray[] = '"' . $field . '"' . ':' . '"' . $value . '"';
		}

		$modelJSON = '{' . implode(',', $modelAsArray) . '}';

		return $modelJSON;

	}

	public function getModelById( $id, $DB )
	{
		$model = $DB->select( ["*"] )
				     ->from("materiale")
				     ->where( "materiale_id = " . $id )
				     ->limit( 1 )
				     ->execute();

		return $model[0];
	}


	public function getAllModelsAsTable( $DB )
	{
		$models = $this->getAllModels( $DB );

		return $this->tableFromModelsArray( $models );
	}

	public function getAllModelsAsOptions( $DB )
	{
		$models = $this->getAllModels( $DB );

		return $this->optionFromModelsArray( $models );
	}

	public function getAllModelsByTypeAsOptions( $type, $DB )
	{
		$models = $this->getAllModelsByType( $type, $DB );
		echo $models;
		return $this->optionFromModelsArray( $models );
	}

	public function insert( $values, $DB )
	{
		$rez = $DB->insert( 'materiale', ["name", "anul ", "price", "stoc", "amount", "series", "nr_invoice", "ziua", 'masura', "tipuri_id"] )
		   ->values( $values )
		   ->execute();
		return $rez;
	}
}