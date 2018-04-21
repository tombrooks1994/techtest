<?php 

require_once('../classes/main.class.php');

$zoopla = new main();
$header = $zoopla->__header();
$output = $zoopla->zoopla();
echo $header;
echo $output;