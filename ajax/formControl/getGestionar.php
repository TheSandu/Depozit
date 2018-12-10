<?php 

include '../../dbModule/DB.php';
include '../../Unites/catedre/Catedre.php';


$DB = new DB( "localhost", "catedre_si_gestionari", "root", "annetta");
$Catedre = new Catedre();

$getCatedra = $_GET['catedra_id'];

echo $Catedre->getCatedreByIdAsJSON( $getCatedra, $DB );