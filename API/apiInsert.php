<?php

include '../dbModule/DB.php';
$DB = new DB( );

include '../Lib/php/StringProcessor.php';

$Request = $_GET['q'];

$RequestParameters = explode('/', $Request);

$RequestTable = $RequestParameters[0];
$RequestField = $RequestParameters[1];
$RequestValue = $RequestParameters[2];


$Response = $DB->select( ['*'] )
               ->from( $RequestTable )
               ->where( "$RequestField = '$RequestValue'" )
               ->execute();

$ResponseJson = json_encode($Response);
echo $ResponseJson;