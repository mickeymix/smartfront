<?php

	function basiccolor2rgb($basiccolor) 
	{
		$basiccolor = strtolower($basiccolor);
		
		if ($basiccolor == "black")
			return array(0,0,0);
		else if ($basiccolor == "gray")
			return array(128,128,128);
		else if ($basiccolor == "silver")
			return array(192,192,192);
		else if ($basiccolor == "white")
			return array(255,255,255);
		else if ($basiccolor == "yellow")
			return array(255,255,0);
		else if ($basiccolor == "lime")
			return array(0,255,0);
		else if ($basiccolor == "aqua")
			return array(0,255,255);
		else if ($basiccolor == "fuchsia")
			return array(255,0,255);
		else if ($basiccolor == "red")
			return array(255,0,0);
		else if ($basiccolor == "green")
			return array(0,128,0);
		else if ($basiccolor == "blue")
			return array(0,0,255);
		else if ($basiccolor == "purple")
			return array(128,0,128);
		else if ($basiccolor == "maroon")
			return array(128,0,0);
		else if ($basiccolor == "olive")
			return array(128,128,0);
		else if ($basiccolor == "navy")
			return array(0,0,128);
		else if ($basiccolor == "teal")
			return array(0,128,128);
		
		return false;
	}

	function hex2rgb($hex) 
	{
		$color = str_replace('#','',$hex);
		$rgb = array(hexdec(substr($color,0,2)),
		hexdec(substr($color,2,2)),
		hexdec(substr($color,4,2)));

		return $rgb;
	}
	
	function color2rgb($color) 
	{
		if ($color == "")
			return false;
		
		if (strpos($color, "#") == false and 
			strpos($color, "0") == false and
			strpos($color, "1") == false and
			strpos($color, "2") == false and
			strpos($color, "3") == false and
			strpos($color, "4") == false and
			strpos($color, "5") == false and
			strpos($color, "6") == false and
			strpos($color, "7") == false and
			strpos($color, "8") == false and
			strpos($color, "9") == false)
		{
			//Rgb convert Basic color.
			return basiccolor2rgb($color);
		}
		else
		{
			//Rgb convert hex color.
			return hex2rgb($color);
		}	
	}
	
	function color2gdcolor($color) 
	{
		$color_rgb = array();
		$color_rgb = color2rgb($color);

		$image = imagecreatetruecolor(1, 1);
		
		return imagecolorallocate($image, $color_rgb[0], $color_rgb[1], $color_rgb[2]);
	}

	/*
	function getmygdcolor($index) 
	{
		$mydcolors = array();
	
		$mydcolors[] = array(51, 153, 255);
		$mydcolors[] = array(255, 204, 51);
		$mydcolors[] = array(0, 153, 102);
		$mydcolors[] = array(204, 51, 153);
		$mydcolors[] = array(255, 102, 0);
		$mydcolors[] = array(51, 255, 102);
		$mydcolors[] = array(244, 49, 84);

		$mydcolors[] = array(50, 50, 50);
		$mydcolors[] = array(200, 200, 200);
		$mydcolors[] = array(173, 137, 60);
		$mydcolors[] = array(55, 84, 138);
		$mydcolors[] = array(135, 246, 209);
		$mydcolors[] = array(232, 162, 209);
		$mydcolors[] = array(242, 223, 166);

		$mydcolors[] = array(255, 255, 0);
		$mydcolors[] = array(0, 0, 255);

		$image = imagecreatetruecolor(1, 1);
		
		if (($index+1) > count($mydcolors)) 
		{	
			srand(make_seed());
			$rand_color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
			
			$unique_color = false;
			while ($unique_color == false)
			{
				$found_same_color = false;
				
				foreach ($mydcolors as $color)
				{
					if ($rand_color == imagecolorallocate($image, $color[0], $color[1], $color[2]))
					{
						srand(make_seed());
						$rand_color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
						$found_same_color = true;
						break;
					}
				}
				if ($found_same_color == false)
					$unique_color = true;
			}
			return $rand_color; 
		}
		else
			return imagecolorallocate($image, $mydcolors[$index][0], $mydcolors[$index][1], $mydcolors[$index][2]);
	}
	*/
	
	function GetTextWidth($text, $font, $font_size)
	{
		$image = imagecreatetruecolor(1, 1);
		$coord = array();
		$angle = 0; //New
		
		$coord = imagettftext($image, 
					$font_size, 
					$angle, 
					0, 
					0, 
					10000, 
					$font, 
					$text);
					
		$width = 0;
					
		$width = ($coord[2] - $coord[0]); 						
	
		if ($width < 0)
			$width *= -1;
	
		imagedestroy($image);
			
		return $width;
	}
		
	function GetTextHeight($text, $font, $font_size, $only_first_sign = false)
	{
		$height = 0;
		$angle = 0; //New

		if (strlen("".$text) > 0)
		{
			if ($only_first_sign == true)
				$text = substr($text, 0, 1);   
			
			$image = imagecreatetruecolor(1, 1);
	
			$coord = array();
			
			$coord = imagettftext($image, 
						$font_size, 
						$angle, 
						0, 
						0, 
						10000, 
						$font, 
						$text);
						
						
			$height = ($coord[5] - $coord[1]); 						
		
			if ($height < 0)
				$height *= -1;
		
			imagedestroy($image);
		}
			
		return $height;
	}

	/*
	function ToRgbRange($number)
	{
		if ($number > 255)
			return intval(-(255 - $number));
		else if ($number < 0)
			return intval((255 + $number));

		return intval($number);
	}
	*/

	function make_seed() 
	{
	    list($usec, $sec) = explode(' ', microtime());
	    return (float) $sec + ((float) $usec * 100000);
	}
	
	function RoundDecimalNumbers($number, $max_length)
	{
		if (strpos("".$number, ".") == false)
			return $number;
			
		if (strlen("".$number) > ($max_length - 1))
		{
			$dot_pos = strpos("".$number, ".");

			if (($max_length - $dot_pos) > 0)
				$number = round($number, $max_length - (strlen("".$dot_pos)));
		}
		return $number;
	}
	
	function FindArrayKeyByValue($arr, $find)
	{
		$found_key = false;
		$arr_keys = array_keys($arr);
		
		foreach ($arr_keys as $key)
		{
			if ($arr[$key] == $find)
			{
				$found_key = $key;
				break;
			}
		}
		return $found_key;
	}
	
?>
