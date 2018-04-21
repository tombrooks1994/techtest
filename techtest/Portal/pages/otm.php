<?php 

require_once('../classes/main.class.php');

$otm = new main();

$header = $otm->__header();
$output = $otm->otm();

echo $header;
echo $output;