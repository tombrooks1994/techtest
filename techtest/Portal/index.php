<?php 

require_once('classes/main.class.php');

$portal = new main();

$output = $portal->display_portal();

echo $output;

print_r($_GET);

if ($_GET['portal'] == 'zp') {
	$url = 'pages/zoopla.php';
	header('Location: ' . $url);
} else if ($_GET['portal'] == 'rm') {
	$url = 'pages/rightmove.php';
	header('Location: ' . $url);
} else if ($_GET['portal'] == 'otm') {
	$url = 'pages/otm.php';
	header('Location: ' . $url);
} else if ($_GET['portal'] != 'rm' || $_GET['portal'] != 'zp' || $_GET['portal'] != 'otm') {
	$url = 'error/404.php';
	header('Location: ' . $url);
}

?> 