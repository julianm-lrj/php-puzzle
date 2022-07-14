<?php

//Set Variables

$i = './input.txt'; 		//data being parsed; curl https://dev2.lsquared.com/dev-lsquared-hub/storage/input.1.txt . 
$o = './result.txt'; 		//output result from code to file
$r = 0;						//counter

//Code - The code will only track where criteria are met. By meeting criteria, $r will be incremented then returned
//via cli and file output with timestamp on when file was execued.

if (file_exists($i)) {
	$a = file($i);
	foreach ($a as $b) {
		//Create array bases on string seperated by delimeters '[' ']'
		$c = preg_split('/\[([^]]+)\]/', $b, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
		$d = 1;
		// Begin Loop
		while ($d <= 10){
			// Loop on bracket positions 1 , 3 , 5 , 7 , 9
			$e = $c[$d];
			//Check if position exist & not empty; required
			switch (!empty($e)) {
				case 0:
					//Bracket'd strings equaling 4 characters are checked for baab.
					//If baab not found, check current $c [0, 2, 4, 6, 8, 10]
					//Incresses $r if met.
					if (strlen($e) == 4) {
						$f = str_split($e, 2);
						if ($f[0] != strrev($f[1])) {
							$g = 0;
							while ($g <=32){
								$h = $c[$g];
								switch(!empty($h)){
									case 0:
										// Set substring position
										$j = 0;
										while($j <= 32){
											$k = substr($h, $j, 4);
											$l = str_split($k,2);
											if ($l[0] == strrev($l[1])) {
												$r++;
												break;
											}else {
												$j++;
											}
										}
										#
									break;
								}
							$g += 2;
							}
							// $r++;
						}
					}
				case 1:
					//Bracket'd strings equaling 4 characters are checked for baab.
					//If baab not found, check current $c [0, 2, 4, 6, 8, 10]
					//Incresses $r if met.
					if (strlen($e) != 4){
						$f = 0;
						while($f <= strlen($e)-4){
							$g = substr($e, $f, 4);
							$h = str_split($g, 2);
							if ($h[0] == strrev($h[1])) {
								break;
							}else{
							$f++;
							}
						}
					}
				break;
			}
			// Incress loop step
			$d += 2;
		}
		// $d = 0;
		// while($d <= 10){
		// 	//Loop through positions 0, 2, 4, 6, 8, 10
		// 	$e = $c[$d];
		// 	switch(!empty($e)){
		// 		case 0
		// 	}
		// }
		
		// while ($d <= 10) {
		// 	$e = $c[$d];	//Set array position
		// 	if (isset($e) && !empty($e)) {
				

		// 	}
		// 	$d = $d+2;		//increase array position by 2
		// }
	}
}
else{						//If input data doesnt eixst
	echo "Input data doesn't exist." ;
}
echo date('c') . ' Number of vaild rows ' . $r;
?>