<?php
$init_time = time(); // START COUNTING EXECUTION TIME
process_files("a_example.in");
process_files("b_small.in");
process_files("c_medium.in");
process_files("d_quite_big.in");
process_files("e_also_big.in");
echo "execution time: <b>" . (time()-$init_time) . "seconds </b"; // END COUNTING EXECUTION TIME


/*
how does it work?
1st create an array of keys
2nd randomly messes them up with php shuffle function
3rd begins to add to see if you get a remainder of 0 or the exact amount of pizza portions that the exercise asks for.
*/
function process_file($filename,$max,$iterate_loop_types,$inputArray){
	$resultsArray = array($iterate_loop_types); 
	$keysToShuffle = array($iterate_loop_types);for($z=0;$z<$iterate_loop_types;$z++)$keysToShuffle[$z]=$z;// array of keys - these keys will change randomly till get the right array
	$bestmatch = 10000;

	for ($iterate_loop = 0; $iterate_loop<1000000;$iterate_loop++){// randomly search up to 1,000,000 times
		shuffle($keysToShuffle); // shuffle the keys
		$sum_of_slices = 0; // initiate the sum with zero.
		for($z=0;$z<count($resultsArray);$z++)$resultsArray[$z]=0; //empty with zeros the result array where we will put the results

		for($c=0; $c<count($inputArray); $c++){ // start adding the elements of the array given by google in the shuffle keys order
			if($max >= $sum_of_slices+$inputArray[$keysToShuffle[$c]]){
				$sum_of_slices += $inputArray[$keysToShuffle[$c]];
				$resultsArray[$keysToShuffle[$c]] = $inputArray[$keysToShuffle[$c]]; 
				if($max == $sum_of_slices) $iterate_loop=1000000000;
				$inputArrayLocalmatch = $max - $sum_of_slices;
			}
		}
		if ($inputArrayLocalmatch<$bestmatch){
			echo "max-sum(s1):".($max-array_sum($resultsArray))."<br>";
			$bestmatch = $inputArrayLocalmatch;
		}
	}
	
	$filename = str_replace(".in",".out",$filename);
	$file = fopen (date("Mj_G_i")."$filename", "w");
	$quantity_of_pizzas = 0;
	for($z=0,$sum_of_slicestr='';$z<count($resultsArray);$z++){
		if ($resultsArray[$z]){
			$quantity_of_pizzas++;
			#if($z<>0) $sum_of_slicestr .= " " . $resultsArray[$z];
			#else  $sum_of_slicestr = $resultsArray[$z];
			if(strlen($sum_of_slicestr)) $sum_of_slicestr .= " " . $z;
			else  $sum_of_slicestr = $z;

		}
	}
	fwrite($file, $quantity_of_pizzas."\n".$sum_of_slicestr."\n");
	fclose ($file);
	echo $quantity_of_pizzas ."\n". "<br>". $sum_of_slicestr."<br>"."<br>";
}

function process_files($filename){
	echo "$filename<br>";
	$myfile = fopen($filename, "r") or die("Unable to open file!");
	$inputArrayLine = fgets($myfile); $inputArrayLine = substr($inputArrayLine,0,-1); $inputArrayline0 = explode(" ", $inputArrayLine);
	#for ($i = 0; $i < count($inputArrayline0);  $i++)echo $inputArrayline0[$i]." ";echo "<br>";
	$inputArrayLine = fgets($myfile); $inputArrayLine = substr($inputArrayLine,0,-1); $inputArrayline1 = explode(" ", $inputArrayLine);
	#for ($i = 0; $i < count($inputArrayline1);  $i++)echo $inputArrayline1[$i]." ";echo "<br>";
	fclose($myfile);
	process_file($filename,$inputArrayline0[0],$inputArrayline0[1],$inputArrayline1);
	echo "<br>-----------------------------------------------------------------------<br>";
}
?>
