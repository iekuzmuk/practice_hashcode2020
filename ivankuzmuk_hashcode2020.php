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
function process_file($filename,$max,$iterate_loopypes,$InputArray){
	$ResultsArray = array($iterate_loopypes); 
	$keysToShuffle = array($iterate_loopypes);for($z=0;$z<$iterate_loopypes;$z++)$keysToShuffle[$z]=$z;// array of keys - these keys will change randomly till get the right array
	$bestmatch = 10000;

	for ($iterate_loop = 0; $iterate_loop<1000000;$iterate_loop++){// randomly search up to 1,000,000 times
		shuffle($keysToShuffle); // shuffle the keys
		$sum_of_slices = 0; // initiate the sum with zero.
		for($z=0;$z<count($ResultsArray);$z++)$ResultsArray[$z]=0; //empty with zeros the result array where we will put the results

		for($c=0; $c<count($InputArray); $c++){ // start adding the elements of the array given by google in the shuffle keys order
			if($max >= $sum_of_slices+$InputArray[$keysToShuffle[$c]]){
				$sum_of_slices += $InputArray[$keysToShuffle[$c]];
				$ResultsArray[$keysToShuffle[$c]] = $InputArray[$keysToShuffle[$c]]; 
				if($max == $sum_of_slices) $iterate_loop=1000000000;
				$InputArrayocalmatch = $max - $sum_of_slices;
			}
		}
		if ($InputArrayocalmatch<$bestmatch){
			echo "max-sum(s1):".($max-array_sum($ResultsArray))."<br>";
			$bestmatch = $InputArrayocalmatch;
		}
	}
	
	$filename = str_replace(".in",".out",$filename);
	$file = fopen (date("Mj_G_i")."$filename", "w");
	$quantity_of_pizzas = 0;
	for($z=0,$sum_of_slicestr='';$z<count($ResultsArray);$z++){
		if ($ResultsArray[$z]){
			$quantity_of_pizzas++;
			#if($z<>0) $sum_of_slicestr .= " " . $ResultsArray[$z];
			#else  $sum_of_slicestr = $ResultsArray[$z];
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
	$InputArrayine = fgets($myfile); $InputArrayine = substr($InputArrayine,0,-1); $InputArrayine0 = explode(" ", $InputArrayine);
	#for ($i = 0; $i < count($InputArrayine0);  $i++)echo $InputArrayine0[$i]." ";echo "<br>";
	$InputArrayine = fgets($myfile); $InputArrayine = substr($InputArrayine,0,-1); $InputArrayine1 = explode(" ", $InputArrayine);
	#for ($i = 0; $i < count($InputArrayine1);  $i++)echo $InputArrayine1[$i]." ";echo "<br>";
	fclose($myfile);
	process_file($filename,$InputArrayine0[0],$InputArrayine0[1],$InputArrayine1);
	echo "<br>-----------------------------------------------------------------------<br>";
}
?>
