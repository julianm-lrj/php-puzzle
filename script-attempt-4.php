<?php

// This code is the answer for a PHP Puzzle by Julian Morley presented by LSquared. 

// The code is designed to take input provided by LSquared, identify squared brackets within each string (s) and parse the 
// bracketted strings (bs). If 'baab' formated substring of the (bs)->(bss) is found, the entire (s) is invalid; move to
// the next (s). If (bss) does not contain 'baab', prosess the outter-bracket string (obs). If the (obs) contains a 'baab'
// string the (s) is valid and will increass the tracking counter ($r). If the (obs) does not contain a 'baab' the (s) is
// invalid and the next (s) will be processed.


// Pre-execution requirements
session_start();				// Start session
// $i = './input.txt'; 			// Data being parsed; curl https://dev2.lsquared.com/dev-lsquared-hub/storage/input.1.txt . 
$i = 'test-input'; 			// Data being parsed; curl https://dev2.lsquared.com/dev-lsquared-hub/storage/input.1.txt . 
$o = './result.txt'; 			// Output result from code to file
$_SESSION['result'] = 0;		// Valid string counter
$_SESSION['current_line'] = 0;	// Initial array position

if(file_exists($i)){
	$a = file($i);
	while ($_SESSION['current_line'] <= count($a) && !empty($a[$_SESSION['current_line']])) {
		$b = $_SESSION['current_line'];
		$c = preg_split('/\[([^]]+)\]/', $a[$b], -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
		in_braket($c);
		$_SESSION['current_line']++;
	}
}
$valid = "The valid number of strings in $i is " . $_SESSION['result'] . ".";	// Build CLI output
$date = date('c');																// Build TimeStamp
$log = $date . " - " . $valid . "\n";											// Build log string
echo $valid;																	// Terminal Output
file_put_contents("./result.log", $log, FILE_APPEND);							// Output to .log file
session_destroy();																// Close Session


function in_braket($c){
	for ($d=1; $d <= count($c) ; $d+=2) { 
		if(isset($c[$d])){
			$e=$c[$d];
			for ($f=0; $f <= strlen($e)-4 ; $f++) { 
				$g = substr($e, $f, 4);
				$h = str_split($g, 2);
				if ($f == strlen($e)-4 && $h[0] != strrev($h[1])){
					out_bracket($c);
				}
				if ($h[0] != strrev($h[1])){
					continue;
				}else{
					break 2;
				}
			}
		}
	}
}

function out_bracket($c){
	for ($j=0; $j <= count($c) ; $j+=2) { 
		if(isset($c[$j])){
			$k=$c[$j];
			for($l=0; $l <= strlen($k)-4; $l++) {
				$m=substr($k, $l, 4);
				$n=str_split($m, 2);
				if($n[0] == $n[1]){
					$_SESSION['result']++;
					break 2;
				}else{
					continue;
				}
			}
		}
	}
}