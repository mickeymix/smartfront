<?php
class Axis
{
	var $image;
	var $x_position = 0;
	var $y_position = 0;
	var $width = 0;
	var $height = 0;
	var $x_number_of_intervals = 0;
	var $y_number_of_intervals = 0;
	var $x_pixel_interval = 0;
	var $y_pixel_interval = 0;
	var $x_number_interval = 0;
	var $y_number_interval = 0;
	var $color;
	var $axis_name_color;
	
	var $font = "";
	var $font_size = 10;
	
	var $y_text_width = 50;
	var $x_text_height = 50;

	var $x_number_max = 0;
	var $y_number_max = 0;
	
	var $x_name = "";
	var $y_name = "";
	
	var $value_names_x = array();
	
	var $x_operator;
	var $y_operator;

	var $user_number_of_hidden_x_intervals;

	function Axis(&$image, 
					$x_position, 
					$y_position, 
					$width, 
					$height, 
					$x_number_max,
					$y_number_max,
					$x_number_of_intervals, 
					$y_number_of_intervals, 
					$color, 
					$font, 
					$font_size, 
					$y_text_width, 
					$x_text_height,
					$x_name, 
					$y_name,
					$value_names_x,
					$axis_name_color,
					$y_text_width,
					$x_operator,
					$y_operator,
					$user_number_of_hidden_x_intervals)
	{
		$this->image = $image;
		$this->x_position = $x_position;
		$this->y_position = $y_position;
		$this->width = $width;
		$this->height = $height;
		$this->x_number_max = $x_number_max;
		$this->y_number_max = $y_number_max;
		$this->x_number_of_intervals = $x_number_of_intervals;
		$this->y_number_of_intervals = $y_number_of_intervals;
		$this->x_pixel_interval = $width/$x_number_of_intervals;
		$this->y_pixel_interval = $height/$y_number_of_intervals;
		$this->x_number_interval = $x_number_max/$x_number_of_intervals;
		$this->y_number_interval = $y_number_max/$y_number_of_intervals;
		
		/*
		$color_rgb = array(); 
		$color_rgb = color2rgb($color); 
		$this->color = imagecolorallocate($this->image, $color_rgb[0], $color_rgb[1], $color_rgb[2]);
		*/
		$this->color = $color;
		
		$this->font = $font;
		$this->font_size = $font_size;

		$this->y_text_width = $y_text_width;
		$this->x_text_height = $x_text_height;

		$this->x_name = $x_name;
		$this->y_name = $y_name;
		
		$this->value_names_x = $value_names_x;

		$this->axis_name_color = $axis_name_color;
		$this->y_text_width = $y_text_width;

		$this->x_operator = $x_operator;
		$this->y_operator = $y_operator;
		
		$this->user_number_of_hidden_x_intervals = $user_number_of_hidden_x_intervals;
	}

	function PaintAxles()
	{
		$start_x_interval = 0;
		$x_max_round_length = 0;
		
		for ($index = 0; $index < ($this->x_number_of_intervals+1); $index++)
		{
			$x_value = "";

			$x_interval_start_index = 0;
			
			if (count($this->value_names_x) > 0)
			{
				if ($index > 0 and ($index-1) < count($this->value_names_x))
					$x_value = $this->value_names_x[($index-1)];
			
				$x_interval_start_index = 1;
			}
			else
			{
				if ($index == 0)
					$x_max_round_length = strlen("".($this->x_number_of_intervals*$this->x_number_interval))+1;
				
				$x_value = RoundDecimalNumbers(($index*$this->x_number_interval), $x_max_round_length);
			}
			
			$operator = "";
			if ($index != 0)
				$operator = $this->x_operator;

			if ($this->user_number_of_hidden_x_intervals == 0 or 
				(($index + $x_interval_start_index - 2) % ($this->user_number_of_hidden_x_intervals + 1) == 0 and $x_interval_start_index == 1) or 
				( ($index) % ($this->user_number_of_hidden_x_intervals+1) == 0 and $x_interval_start_index == 0))
			{
				//X 10, 20, 30... -
				imagettftext($this->image, 
								$this->font_size, 
								0, 
								$this->x_position + $start_x_interval - (GetTextWidth($operator."".$x_value, $this->font, $this->font_size)/2), 
								8 + $this->height + $this->y_position + (GetTextHeight($operator."".$x_value, $this->font, $this->font_size)/2) + 5, 
								$this->color, 
								$this->font, 
								$operator."".$x_value);
			}
							
			if (($this->x_number_of_intervals-1) == $index)
			{
				//Make sure that interval shows up in image.
				$start_x_interval = $this->width;
			}
			else
			{
				//Normal interval.
				$start_x_interval += $this->x_pixel_interval;
			}
		}
		
		$start_y_interval = 0;
		$y_max_round_length = 0;
	
		for ($index = $this->y_number_of_intervals; $index > -1; $index--)
		{
			if ($index == $this->y_number_of_intervals)
				$y_max_round_length = strlen("".($index*$this->y_number_interval))+1;
				
			$y_roundnumber = RoundDecimalNumbers(($index * $this->y_number_interval), $y_max_round_length);
				
			$operator = "";
			if ($index != 0)
				$operator = $this->y_operator;
			
			//Y 10, 20, 30...   |
			imagettftext($this->image, 
							$this->font_size, 
							0, 
							($this->x_position) - ((GetTextWidth($operator."".$y_roundnumber, $this->font, $this->font_size))) - 8, 
							$start_y_interval + 5 + $this->y_position, 
							$this->color, 
							$this->font, 
							$operator."".$y_roundnumber);
							
			if (1 == $index)
			{
				//Make sure that interval shows up in image.
				$start_y_interval = $this->height;
			}
			else
			{
				//Normal interval.
				$start_y_interval += $this->y_pixel_interval;
			}
		}
		
		//Streck imellan axel nivåerna.
		//Y-linje |
		imageline($this->image, 
					$this->x_position, 
					$this->y_position + $this->height, 
					$this->x_position + $this->width, 
					$this->y_position + $this->height, 
					$this->color);
		
		//Streck imellan axel nivåerna.
		//X-linje -
		imageline($this->image, 
					$this->x_position, 
					$this->y_position, 
					$this->x_position, 
					$this->y_position + $this->height, 
					$this->color);
		
		//Axle names.
		//X = Horizontal name.
		imagettftext($this->image, 
						$this->font_size+2, 
						0, 
						$this->x_position + ($this->width/2) - (GetTextWidth($this->x_name, $this->font, $this->font_size+2)/2), 
						$this->y_position + $this->height + 49 - GetTextHeight($this->x_name, $this->font, $this->font_size+2), 
						$this->axis_name_color, 
						$this->font, 
						$this->x_name);
						
		//echo "a".$this->axis_name_color."<br/>";
						
		//Y = Vertical name.
		imagettftext($this->image, 
					$this->font_size+2, 
					90, 
					$this->x_position - $this->y_text_width - (GetTextHeight($this->y_name, $this->font, $this->font_size+2)/2) + 10, 
					$this->y_position + ($this->height/2) + ((GetTextWidth($this->y_name, $this->font, $this->font_size+2, 0))/2), 
					$this->axis_name_color, 
					$this->font, 
					$this->y_name);
	}
}
?>