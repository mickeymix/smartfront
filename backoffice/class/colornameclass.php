<?php
class ColorName
{
	var $names;
	var $colors;
	var $start_x = array();
	var $start_y = array();
	var $y_position = 0;
	var $width = 0;
	var $height = 20;
	var $width_color_to_name = 10;
	var $width_name_to_color = 20;
	var $line_height = 0;
	var $background_color;
	
	var $font;
	var $font_size = 0;
	var $font_color;
	var $change_line_indexes = array();
	var $dot_width = 8;
	
	var $width_between_names = array();
	var $max_number_of_names_on_each_line;
			
	
	var $number_of_names_each_line = 0;
	var $widestname = 0;
	var $border_color;
	
	function ColorName($names, $colors, $y_position, $width, $font, $font_size, $font_color, $background_color, $border_color)
	{
		$this->names = $names;
		$this->colors = $colors;
		$this->y_position = $y_position;
		$this->width = $width;
		
		$this->font = $font;
		$this->font_size = $font_size;
		$this->font_color = $font_color;
		$this->background_color = $background_color;
		$this->border_color = $border_color;
	}

	function CalculateHeight()
	{
		//1.Find widest name.
		//2.intval( TotalWidth / WidestName ) = Number of names on each line. 
		//3.Calculate height.
		$this->widestname = 0;
		$this->number_of_names_each_line = 0;
		$this->line_height = 0;
		
		//1.
		for ($index = 0; $index < count($this->names); $index++)
		{
			if (($this->width_color_to_name + GetTextWidth($this->names[$index], $this->font, $this->font_size) + $this->width_name_to_color) > $this->widestname)
				$this->widestname = ($this->width_color_to_name + GetTextWidth($this->names[$index], $this->font, $this->font_size) + $this->width_name_to_color);
			
			if (GetTextHeight($this->names[$index], $this->font, $this->font_size) > $this->line_height)
				$this->line_height = GetTextHeight($this->names[$index], $this->font, $this->font_size);
		}
		
		if ($this->line_height < ($this->dot_width+6))
			$this->line_height = ($this->dot_width+6);
		else
			$this->line_height += 2;
		
		//2.
		$this->number_of_names_each_line = intval(($this->width)/$this->widestname);
		if (count($this->names) < $this->number_of_names_each_line)
			$this->number_of_names_each_line = count($this->names);
			
		if ($this->number_of_names_each_line < 1)
			$this->number_of_names_each_line = 1;
		
		//3.
		$lines = 0;
		if ((count($this->names) % $this->number_of_names_each_line) != 0)
			$lines = intval(count($this->names) / $this->number_of_names_each_line) + 1;
		else
			$lines = (count($this->names) / $this->number_of_names_each_line);
		
		$this->height = ($lines * $this->line_height) + 5;
		
		return $this->height;	
	}
	
	function PaintColorNames(&$image)
	{
		$y_tmp = $this->y_position + 14;
		$index_change_line = 0;
		
		imagefilledrectangle($image, 
							1, 
							$this->y_position, 
							$this->width-2, 
							$this->y_position + $this->height-1, 
							$this->background_color);
		imageline($image, 
					1, 
					$this->y_position, 
					$this->width-2, 
					$this->y_position, 
					$this->border_color);
							
		$line_name_index = 0;					
		$x_tmp = $this->CalculateWidthFromLeft();
		
		$index = 0;
		for ($index = 0; $index < count($this->names); $index++)
		{
			//echo $index." ".$this->colors[$index]."<br/>";
			
			imagefilledellipse($image, 
								$x_tmp, 
								$y_tmp-($this->dot_width/2), 
								$this->dot_width, 
								$this->dot_width, 
								$this->colors[$index]);


			imagettftext($image, 
						$this->font_size, 
						0, 
						$x_tmp + $this->width_color_to_name, 
						$y_tmp, 
						$this->font_color, 
						$this->font, 
						$this->names[$index]);
					
			$x_tmp += $this->widestname;
						
			$line_name_index++;
			if ($this->number_of_names_each_line == $line_name_index)
			{
				$line_name_index = 0;	
				$x_tmp = $this->CalculateWidthFromLeft();
				
				$y_tmp += $this->line_height;
			}
		}
		//echo "<br/><br/>";
	}
	
	function CalculateWidthFromLeft()
	{
		$fromleft = ($this->width/2) - (($this->number_of_names_each_line * $this->widestname)/2) + ($this->width_name_to_color/2);
		
		if ($fromleft < 7)
			$fromleft = 15;
			
		return $fromleft;
	}
}
?>