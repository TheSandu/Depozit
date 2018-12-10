<?php


include '../../dbModule/DB.php';
include '../../Unites/users/User.php';

$DB = new DB( "localhost", "catedre_si_gestionari", "root", "annetta");
$Users = new Users();

$tehnic_types_id = $_POST['role'];
$denumirea = $_POST['modelName'];
$pret = $_POST['pret'];
$total = $_POST['total'];

$Users->insert( [ $userName,, $roleId ],$DB );