<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

include_once("./Controller/controller.php");
$controller= new Controller();
$output = $controller->execute();
echo $output;
?>