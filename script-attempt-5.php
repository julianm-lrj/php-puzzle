<?php
session_start();
$i = 'test-input';
$o = 'result.txt';
$_SESSION['cl'] = 0;
$r = 0;

if(file_exists($i)){
	$a=file($i);
	foreach ($a as $b) {
		$c = preg_split('/\[([^]]+)\]/', $b, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
	}
} echo $r;
?>