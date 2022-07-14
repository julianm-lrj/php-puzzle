<?php
// Variables
$i = './input.txt';
$r = 'result.txt';

// Code

// Check
if (file_exists($i)) {
	$a = file($i);
	foreach ($a as $b) {
		// $c ="[";
		// $d = "]";		
		$c= preg_split('/\[([^]]+)\]/',$b,-1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
		$d=0;
		while ($d <= 10) {
			$e = $c[$d];
			if (isset($e) && !empty($e)) {
				$f = str_split($e, 4); 
				foreach($f as $g){
					$h=str_split($g, 2);
				}

				if (strlen($e)) {
				}
				if ($c[$d] !== strrev($c[$d])) {
					file_put_contents($r, $b, FILE_APPEND);
				}
			}
			$d++;
		}
		print_r($c);
		// print_r($c[0]);
		// print_r(strrev($c[0]));
		// print(count($c));
	}
}
?>