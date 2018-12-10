<?php 

include '../../dbModule/DB.php';
include '../../Unites/models/Models.php';


$DB = new DB( "localhost", "catedre_si_gestionari", "root", "annetta");
$Models = new Models();

$getModel = $_GET['model_id'];

echo $Models->getModelByIdAsJSON( $getModel, $DB );