<?php

/**
 * Execute operation with strings
 */
class StringProcessor
{
	public static function JsonToTabel( $json )
	{
		$jsonArray = json_decode( $json );

		$table = '<table>';

		foreach ($jsonArray as $rowKey => $rowValue) {

			$table .= '<tr>';

			foreach ($rowValue as $cellKey => $cellValue) {
			$table .= '<td>';
			$table .= $cellValue;
			$table .= '</td>';
				
			}

			$table .= '</tr>';
		}

		$table .= '</table>';
	}

	public static function ArrayAsJSON( $array )
	{
		$modelAsArray = [];
		$rezultArray = [];echo var_dump($array);
		echo "<br>---------------<br>";
		foreach ($array as $key => $element) {		
			foreach ($element as $field => $value) {
				 $modelAsArray[] = "\"$field\" : \"$value\"";
			}
			echo var_dump($modelAsArray);
			$modelJSON = "{" . implode(",", $modelAsArray) . "}";
			$rezultArray[] = $modelJSON;
		}
			$rezultJson = "[" . implode(",", $rezultArray) . "]";

		return $rezultJson;
	}

	private function UnitesAsOption( $unites )
	{
		$options = "";

		for ($i = 0, $unitesCount = count($unites); $i < $unitesCount; $i++) { 
			$options .= "<option value=" . reset($unites[$i]) . ">" .$unites[$i]['name'] ."</option>";
		}

		return $options;
	}
}