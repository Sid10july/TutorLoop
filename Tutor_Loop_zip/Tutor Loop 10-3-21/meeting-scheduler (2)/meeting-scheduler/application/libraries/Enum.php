<?php
class Enum
{
	function __construct (){}
}

 

class Status_select {
	
	const Active = 1;
	const Inactive = 0;
	
 	public static function getValue($value = NULL) {
		$class = new ReflectionClass('Status_select');
		$constants = $class->getConstants();
		$constants = toProperCase(array_flip($constants),'_');
		if($value !== NULL) {
			return $constants[$value];
		}
		return $constants;
	}
}