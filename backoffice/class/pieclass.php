<?php
class Pie
{
	var $x_center_position = 0;
	var $y_center_position = 0;
	var $diameter = 0;
	var $radius = 0;
	var $border_color = 0;
	var $values_pie = array(); //name, procent.
	
	function Pie($x_center_position,
					$y_center_position,
					$diameter,
					$border_color)
	{
		$this->x_center_position = $x_center_position;
		$this->y_center_position = $y_center_position;
		$this->diameter = round($diameter);
		$this->radius = ($this->diameter/2);
		$this->circel_length = $this->diameter*pi();
		$this->border_color = $border_color;
	}

	function GetValueNamesWithProcent()
	{
		$new_value_names = array();
		$value_keys = array_keys($this->values_pie); 
			
		foreach ($value_keys as $key)
			$new_value_names[$key] = $this->values_pie[$key]["procent"]."% ".$this->values_pie[$key]["name"];

		return $new_value_names;
	}
	
	function GetNewValueColors()
	{
		$new_value_colors = array();
		$value_keys = array_keys($this->values_pie); 
			
		foreach ($value_keys as $key)
			$new_value_colors[$key] = $this->values_pie[$key]["color"];

		return $new_value_colors;
	}
	
	function CalculatePieValues($values)
	{
		$sum_of_all_values = 0;
		$number_of_y_values = count($values);
		$value_keys = array_keys($values); 

		unset($this->values_pie);
		$values_pie_new = array(); 
		
		foreach ($value_keys as $key)
		{
			$sum_of_all_values += $values[$key]->y;
		
			$this->values_pie[$key]["name"] = $values[$key]->value_name; 
			$this->values_pie[$key]["procent"] = $values[$key]->y; 
			$this->values_pie[$key]["color"] = $values[$key]->color; 
		}
		
		$procents_left = 100;
		for ($index = 0; $index < count($this->values_pie); $index++)
		{
			if ($procents_left > 0)
			{	
				if ($sum_of_all_values != 0)
				{
					$this->values_pie[$index]["procent"] = (($this->values_pie[$index]["procent"]/$sum_of_all_values)*100); 
					
					if ($this->values_pie[$index]["procent"] > 0 and $this->values_pie[$index]["procent"] < 1) //Or else, some values will not be shown.
						$this->values_pie[$index]["procent"] = 1; 
					else
						$this->values_pie[$index]["procent"] = round($this->values_pie[$index]["procent"], 0); 
				}
				else
					$this->values_pie[$index]["procent"] = 0;
			}
				
			$procents_left -= $this->values_pie[$index]["procent"];
			
			if ($procents_left != 0 and $procents_left > 0 and $index == (count($this->values_pie)-1))
				$this->values_pie[$index]["procent"] += $procents_left;
			
			//Add value.
			if ($this->values_pie[$index]["procent"] != 0)
				$values_pie_new[] = $this->values_pie[$index];	
				
			/*
			if 	($procents_left == 1)
			{
				if (array_key_exists($index+1, $this->values_pie) == true)
				{
					//Find the value key index with the highet value = value nearest one procent.
					$index++;
					$find_value = $this->values_pie[$index]["procent"];
					$find_index = $index;
					
					for ($tmp_index = $index; $tmp_index < count($this->values_pie); $tmp_index++)
					{
						if ($this->values_pie[$tmp_index]["procent"] > $find_value)
						{	
							$find_value = $this->values_pie[$tmp_index]["procent"];
							$find_index = $tmp_index;
						}
					}
					$index = $find_index;
					$index--; //Because of the for loop ++.
				}
			}
			*/
				
			if 	($procents_left <= 0)
				break;
		}
		
		unset($this->values_pie);
		$this->values_pie = $values_pie_new; 
	}

	function PaintPie(&$image)
	{
		$start_degrees = 0;
		for ($index = 0; $index < count($this->values_pie); $index++)
		{
			imagefilledarc($image, $this->x_center_position, $this->y_center_position, $this->diameter, $this->diameter, $start_degrees, $start_degrees + ($this->values_pie[$index]["procent"]*3.6), $this->values_pie[$index]["color"], IMG_ARC_PIE);
			$start_degrees += $this->values_pie[$index]["procent"]*3.6;
		}
		imagefilledarc($image, $this->x_center_position, $this->y_center_position, $this->diameter, $this->diameter, 0, 360, $this->border_color, IMG_ARC_NOFILL);
	}
}
?>