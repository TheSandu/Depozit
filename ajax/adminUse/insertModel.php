<?php


include '../../dbModule/DB.php';
include '../../Unites/models/Models.php';


$DB = new DB( "localhost", "catedre_si_gestionari", "root", "annetta" );
$Models = new Models();

$denumirea = $_POST['modelName'];
$total = $_POST['total'];
$pret = $_POST['pret'];
$tehnic_types_id = $_POST['type'];


$Models->insert( [ $denumirea, $total, $pret, 0, 0, $tehnic_types_id ], $DB );