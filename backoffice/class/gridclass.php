<?php
class Grid
{
	var $image;
	var $x_position = 0;
	var $y_position = 0;
	var $width = 0;
	var $height = 0;
	var $x_number_of_intervals = 0;
	var $y_number_of_intervals = 0;
	var $x_interval = 0;
	var $y_interval = 0;
	var $color;
	var $background_color;
	var $use_background_color = true;
	var $mode;
	
	function Grid(&$image, $x_position, $y_position, $width, $height, $x_number_of_intervals, $y_number_of_intervals, $color, $grid_background_color, $mode)
	{
		$this->image = $image;
		$this->x_position = $x_position;
		$this->y_position = $y_position;
		$this->width = $width;
		$this->height = $height;
		$this->x_number_of_intervals = $x_number_of_intervals;
		$this->y_number_of_intervals = $y_number_of_intervals;
		$this->x_interval = $width/$x_number_of_intervals;
		$this->y_interval = $height/$y_number_of_intervals;
		
		$color_rgb = array(); 
		$color_rgb = color2rgb($color); 
		$this->color = imagecolorallocate($this->image, $color_rgb[0], $color_rgb[1], $color);
		$this->background_color = $grid_background_color;
		$this->mode = $mode;
	}

	function PaintGrid()
	{
		if ($this->use_background_color == true)
		{
			imagefilledrectangle($this->image, 
								$this->x_position, 
								$this->y_position, 
								$this->x_position + $this->width, 
								$this->y_position + $this->height, 
								$this->background_color);
		}
		
		$start_x_interval = 0;
	
		for ($index = 0; $index < ($this->x_number_of_intervals+1); $index++)
		{
			if (($this->mode != CHART_X_VALUE_NAMES and $this->mode != CHART_VALUE_NAMES_AND_X_VALUE_NAMES) or $index == $this->x_number_of_intervals)
			{
				//X = |
				imageline($this->image, 
							$this->x_position + $start_x_interval, 
							$this->y_position, 
							$this->x_position + $start_x_interval, 
							$this->y_position + $this->height, 
							$this->color);
			}

			if (($this->x_number_of_intervals-1) == $index)
			{
				//Make sure that interval shows up in image.
				$start_x_interval = $this->width;
			}
			else
			{
				//Normal interval.
				$start_x_interval += $this->x_interval;
			}
		}
				
		$start_y_interval = 0;
	
		for ($index = 0; $index < ($this->y_number_of_intervals+1); $index++)
		{
			//Y = -
			imageline($this->image, 
						$this->x_position, 
						$this->y_position + $start_y_interval, 
						$this->x_position + $this->width, 
						$this->y_position + $start_y_interval, 
						$this->color);

			if (($this->y_number_of_intervals-1) == $index)
			{
				//Make sure that interval shows up in image.
				$start_y_interval = $this->height;
			}
			else
			{
				//Normal interval.
				$start_y_interval += $this->y_interval;
			}
		}
	}
}
?>