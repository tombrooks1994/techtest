<?php 

require_once('../classes/main.class.php');

$rm = new main();
$header = $rm->__header();
$output = $rm->rightmove();

echo $header;
echo $output;