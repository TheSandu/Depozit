<?php

include '../../dbModule/DB.php';
include '../../Unites/models/Models.php';


$DB = new DB( "localhost", "catedre_si_gestionari", "root", "annetta");
$Models = new Models();

$tehnica_type = $_GET['type'];

echo $Models->getAllModelsByTypeAsOptions( $tehnica_type, $DB  ); 
?>