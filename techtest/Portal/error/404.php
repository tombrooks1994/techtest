<?php 

require_once("../classes/main.class.php");

$error = new main();

$output = $error->badrequest();

echo $output;

?>