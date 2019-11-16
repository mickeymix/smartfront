<?php
class ColorManager
{
	var $colors = array();
	var $final_colors = array();
	var $added_colors = array();
	var $number_of_added_colors = 0;
	
	function ColorManager()
	{
		$this->LoadColors();
	}
		
	function AddColor($org_color)
	{
		//Add color at the first place in array.
		//echo $org_color."<br/><br/>";
		
		$gd_color = color2gdcolor($org_color);
		$this->RemoveColor($org_color, false);
	
		$new_added_colors = array();
		foreach ($this->added_colors as $color)
			$new_added_colors[] = $color;	
		
		$new_added_colors[] = $gd_color; 

		unset($this->added_colors);
		$this->added_colors = $new_added_colors;	
		
		$this->LoadFinalColors();
	}

	function LoadFinalColors()
	{ 
		$new_colors = array();
		foreach ($this->added_colors as $color)
			$new_colors[] = $color;	

		foreach ($this->colors as $color)
			$new_colors[] = $color;	
		
		unset($this->final_colors); 
		$this->final_colors = $new_colors;
	}
	
	function RemoveColor($org_color, $loadfinal = true)
	{
		$gd_color = color2gdcolor($org_color);
		
		if (count($this->added_colors) > 0)
		{
			$found_delete_key = FindArrayKeyByValue($this->added_colors, $gd_color); 
			if ($found_delete_key !== false)
			{		
				unset($this->added_colors[$found_delete_key]);
				//echo "remove add color: ".$org_color."<br/>";
			}
		}
			
		if (count($this->colors) > 0)
		{
			$found_delete_key = FindArrayKeyByValue($this->colors, $gd_color); 
			if ($found_delete_key !== false)
			{	
				unset($this->colors[$found_delete_key]);
				//echo "remove base color: ".$org_color."<br/>";
			}
		}
		
		if ($loadfinal == true)
			$this->LoadFinalColors();
	}

	function GetColor($index)
	{
		if (array_key_exists($index, $this->final_colors) == true)
			return $this->final_colors[$index];
		else
			return "-1";
	}

	function LoadColors() 
	{
		$image = imagecreatetruecolor(1, 1);

		$this->colors[] = imagecolorallocate($image, 51, 153, 255);
		$this->colors[] = imagecolorallocate($image, 255, 204, 51);
		$this->colors[] = imagecolorallocate($image, 0, 153, 102);
		$this->colors[] = imagecolorallocate($image, 204, 51, 153);
		$this->colors[] = imagecolorallocate($image, 255, 102, 0);
		$this->colors[] = imagecolorallocate($image, 51, 255, 102);
		$this->colors[] = imagecolorallocate($image, 244, 49, 84);
		$this->colors[] = imagecolorallocate($image, 50, 50, 50);
		$this->colors[] = imagecolorallocate($image, 200, 200, 200);
		$this->colors[] = imagecolorallocate($image, 173, 137, 60);
		$this->colors[] = imagecolorallocate($image, 55, 84, 138);
		$this->colors[] = imagecolorallocate($image, 135, 246, 209);
		$this->colors[] = imagecolorallocate($image, 232, 162, 209);
		$this->colors[] = imagecolorallocate($image, 242, 223, 166);
		$this->colors[] = imagecolorallocate($image, 255, 255, 0);
		$this->colors[] = imagecolorallocate($image, 0, 0, 255);
		
		for ($i = 0; $i < 25; $i++) 
		{	
			srand(make_seed());
			$rand_color = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
			
			if (array_search($rand_color, $this->colors) === false)
				$this->colors[] = $rand_color;
			
			//echo "rand: ".$rand_color."<br/>";
		}
		//unset($this->final_colors);
		//$this->final_colors = array();
		$this->final_colors = $this->colors;
	}	
}
?>