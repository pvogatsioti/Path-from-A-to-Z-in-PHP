<!DOCTYPE html>
<html lang = "en-US">

	<head>
		<meta charset = "UTF-8">
		<title> Question 2 </title>
	</head>
	<body>
	<?php
	$myfile = file("C:/Users/Babouski/Desktop/Entry Interview/board.txt"); // place contents of the file in an array of strings

	for ($i=0; $i<sizeof($myfile); $i++)
		$myfile[$i] = trim($myfile[$i]); //trim the extra space because we need just the characters



	for ($i=0; $i<sizeof($myfile); $i++){
		for($j=0; $j<strlen($myfile[$i]); $j++){
			$visited[$i][$j]=FALSE;		//visited is an array that keeps is a pair(i,j) from our board of characters has been visited before so we don't have loops
			if($myfile[$i][$j]=="A"){	//----
				$a_x = $i;				//--
				$a_y = $j;				//-
				$visited[$i][$j]=TRUE;	//Find which position hold the 'A' and put it to the path
				$path[0][0] = $i;		//--
				$path[0][1] = $j;		//----

			}
		}
	}



	$o_x = $a_x;
	$o_y = $a_y;
	$found = FALSE; //a variable that will be set true only when we find the 'Z'
	$path_size = 1; // The number of the lines of the array that keeps the path
	$count_x = 0;	// The number of the lines of the array that keeps all the '0's that was visited
	while(1){ // The loop will break when we find 'Z' otherwise it will keep creating the path

		$count2 = 0; // if count2=0 then we found either a 'z' or an 'x' else we found a '0'
		if (($o_x == $a_x) && ($o_y == $a_y)){ // this if is because the A position of lines is 0 so we cant iterate line -1
											//for a more general routine we should check more options but to keep the routine simple I didn't because all the '0's are in inner index
			if ($myfile[$o_x][$o_y-1]=="0"&& $visited[$o_x][$o_y-1]==FALSE){
				$my_array[$count_x][0]= $o_x;
				$my_array[$count_x][1]= $o_y-1;
				$count_x++;
				$count2++;
				$visited[$o_x][$o_y-1]=TRUE;

			}
			if ($myfile[$o_x][$o_y+1]=="0" && $visited[$o_x][$o_y+1]==FALSE){
				$my_array[$count_x][0]= $o_x;
				$my_array[$count_x][1]= $o_y+1;
				$count_x++;
				$count2++;
				$visited[$o_x][$o_y+1]=TRUE;

			}
			if ($myfile[$o_x+1][$o_y]=="0" && $visited[$o_x+1][$o_y]==FALSE){
				$my_array[$count_x][0]= $o_x+1;
				$my_array[$count_x][1]= $o_y;
				$count_x++;
				$count2++;
				$visited[$o_x+1][$o_y]=TRUE;

			}
		}
		else{ // if the element we are now is not the 'A'

			if ($myfile[$o_x][$o_y-1]=="0" && $visited[$o_x][$o_y-1]==FALSE){
				$my_array[$count_x][0]= $o_x;
				$my_array[$count_x][1]= $o_y-1;
				$count_x++;
				$count2++;
				$visited[$o_x][$o_y-1]=TRUE;

			}
			else if ($myfile[$o_x][$o_y+1]=="0" && $visited[$o_x][$o_y+1]==FALSE){
				$my_array[$count_x][0]= $o_x;
				$my_array[$count_x][1]= $o_y+1;
				$count_x++;
				$count2++;
				$visited[$o_x][$o_y+1]=TRUE;

			}

			else if ($myfile[$o_x-1][$o_y]=="0"&& $visited[$o_x-1][$o_y]==FALSE){
				$my_array[$count_x][0]= $o_x-1;
				$my_array[$count_x][1]= $o_y;
				$count_x++;
				$count2++;
				$visited[$o_x-1][$o_y]=TRUE;

			}
			else if ($myfile[$o_x+1][$o_y]=="0"&& $visited[$o_x+1][$o_y]==FALSE){
				$my_array[$count_x][0]= $o_x+1;
				$my_array[$count_x][1]= $o_y;
				$count_x++;
				$count2++;
				$visited[$o_x+1][$o_y]=TRUE;

			}
			else{// if the element we are is not a '0' we check if 'Z'
				if($myfile[$o_x][$o_y-1]== "Z"){
					$found = TRUE;
					$z_pos_x = $o_x;
					$z_pos_y = $o_y-1;
					$path_size++;

				}
				else if($myfile[$o_x][$o_y+1]== "Z"){
					$found = TRUE;
					$z_pos_x = $o_x;
					$z_pos_y = $o_y+1;
					$path_size++;

				}
				else if($myfile[$o_x-1][$o_y]== "Z"){
					$found = TRUE;
					$z_pos_x = $o_x-1;
					$z_pos_y = $o_y;
					$path_size++;

				}
				else if($myfile[$o_x+1][$o_y]== "Z"){
					$found = TRUE;
					$z_pos_x = $o_x+1;
					$z_pos_y = $o_y;
					$path_size++;

				}

			}
		}


		if($count2>0){ // Element is '0'
			$o_x = $my_array[$count_x-1][0];
			$o_y = $my_array[$count_x-1][1];
			$path[$path_size][0] = $o_x;
			$path[$path_size][1] = $o_y;
			$path_size++;

		}
		else{
			if($found == TRUE){ // element is 'Z'
				$path[$path_size-1][0] = $z_pos_x;
				$path[$path_size-1][1] = $z_pos_y;

				break;
			}
			else{ // element is 'X'
				$path_size--; // if x we have to go back until we find an other element with '0' that we haven't visited yet
				$o_x = $path[$path_size-1][0];// change
				$o_y = $path[$path_size-1][1];


			}
		}





	}
	echo "The path is :";
	for ($i=0; $i<sizeof($path); $i++)
		echo "<br/>(". $path[$i][0].")(".$path[$i][1].") = ".$myfile[$path[$i][0]][$path[$i][1]]."<br/>";





	?>
	</body>
</html>
