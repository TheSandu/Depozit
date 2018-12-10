<?php

/**
 * Manage excel files
 */
class Excel
{

	public function getDataFromUrl( $url )
	{
		// $excelFileDirectory = "C://OSPanel/domains/demersuri/documents/data.xlsx";
		$excelObject = PHPExcel_IOFactory::load($url);

		// $sheet = $excelObject->getActiveSheet()->toArray(null);

		$sheet = $excelObject->getActiveSheet()->toArray(null);
		// echo "<pre>";
		// var_dump( $sheet );
		// echo "</pre>";
		return $sheet;
	}


}