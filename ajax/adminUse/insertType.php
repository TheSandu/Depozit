<?php


include '../../dbModule/DB.php';
include '../../Unites/types/Types.php';


$DB = new DB( "localhost", "catedre_si_gestionari", "root", "annetta" );
$Types = new Types();

$denumirea = $_POST['modelName'];

$Types->insert( [ $denumirea ], $DB );