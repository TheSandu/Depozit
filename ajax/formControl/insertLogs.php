<?php

include '../../../dbModule/DB.php';

$DB = new DB();


$DB = new DB();

$fields = ["biroul", "depozitul", "destinatarul", "gestionar", "nr_depozit", "denumirea", "eliberat", "masura", "pretul", "solicitat"];
$DB->insert( 'logs', $fields )
   ->values( [$_POST["biroul"], $_POST["depozitul"], $_POST["destinatarul"], $_POST["gestionar"], $_POST["nr_depozit"], $_POST["denumirea"], $_POST["eliberat"], $_POST["masura"], $_POST["pretul"], $_POST["solicitat"]] )
   ->execute();
   echo "14 : insertLogs.php";