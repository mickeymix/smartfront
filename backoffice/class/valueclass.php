<?php
class Value
{
	var $x = 0;
	var $y = 0;
	var $x_scaled = 0;
	var $y_scaled = 0;
	var $width = 10;
	var $color;
	var $value_name;
	var $x_value_type = -1;
	var $value_type = -1;

	function Value($x, $y, $value_name = "")
	{
		$colorimage = imagecreatetruecolor(1, 1);
		$this->color = imagecolorallocate ($colorimage, 39, 86, 179);
		
		$this->x = $x;
		$this->y = $y;

		$this->value_name = $value_name;
	}
	
	function CompareMinimumX($a, $b) 
	{
	    if ($a->x == $b->x) 
	    	return 0;
	    	
	    return ($a->x < $b->x) ? -1 : 1;
	}
	
	function CompareMinimumXValueType($a, $b) 
	{
	    if ($a->x_value_type == $b->x_value_type) 
	    	return 0;
	    	
	    return ($a->x_value_type < $b->x_value_type) ? -1 : 1;
	}
}
?>