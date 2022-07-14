<?php
// This code is the answer for a PHP Puzzle by Julian Morley presented by LSquared. 

// The code is designed to take input provided by LSquared, identify squared brackets within each string (s) and parse the 
// bracketted strings (bs). If 'baab' formated substring of the (bs)->(bss) is found, the entire (s) is invalid; move to
// the next (s). If (bss) does not contain 'baab', prosess the outter-bracket string (obs). If the (obs) contains a 'baab'
// string the (s) is valid and will increass the tracking counter ($r). If the (obs) does not contain a 'baab' the (s) is
// invalid and the next (s) will be processed.


// Initial Variables
$i = './input.txt'; 		//data being parsed; curl https://dev2.lsquared.com/dev-lsquared-hub/storage/input.1.txt . 
$o = './result.txt'; 		//output result from code to file
$r = 0;						//counter
$z = "continue 1";
$y = "continue 2";
$x = "continue 5";

// Code execution
if(file_exists($i)){
	$a = file($i);
	foreach ($a as $b) {
		// Process (s) and create array using '[' and ']' as delimiters
		$c = preg_split('/\[([^]]+)\]/', $b, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
		for ($d=1; $d <= count($c) ; $d+=2) { 								// Prossess current (bs)
			if(isset($c[$d])){
				$e = $c[$d];
			}else {															// Stop; Process next (bs)
				$z;
			}
			for ($f=0; $f <= strlen($e)-4 ; $f++) { 						// Process current (bss)
				$g = substr($e, $f, 4);
				$h=str_split($g, 2);
				if ($h[0] == strrev($h[1])) {								// If (bs) contains 'baab' process new (s) 
					$y;
				} elseif ($h[0] != strrev($h[1]) && $f < strlen($e)-4) { 	// If (bs) does not contains 'baab' and not end of (bs) continue process
					$z;
				} elseif ($f == strlen($e)-4 && $h[0] != $h[1]) { 			// If entire (bs) processed and no 'baab' found process (obs)
					for ($j=0; $j <= count($c); $j+=2) {					// Loop (obs) process start
						if (isset($c[$j])){									// Check if (obs) array position exist
							$k = $c[$j];
						}else{												// If (obs) array position does not exist new (s) process
							$y;
						}
						for ($l=0; $l <= strlen($k)-4 ; $l++) { 			// If (obs) position exist process to look for 'baab'
							$m = substr($k, $l, 4);							
							$n = str_split($m, 2);							 
							if ($n[0] == strrev($n[1])) {					// If 'baab' exist incress result variable and process new (s)
								$r++;
								$x;
							}
						}
					}	
				}				
			}
		}
	}
}
$valid = "The valid number of strings in $i is $r.";						// Build CLI output
$date = date('c');															// Build TimeStamp
$log = $date . " - " . $valid;												// Build log string
echo $valid;																// Terminal Output
file_put_contents("./result.log", $log, FILE_APPEND);						// Output to .log file