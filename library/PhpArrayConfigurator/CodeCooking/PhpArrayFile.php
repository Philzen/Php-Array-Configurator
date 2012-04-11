<?php

namespace PhpArrayConfigurator\CodeCooking
{
	class PhpArrayFile
	{
		protected static $recursionLevel = 0;
		public static function getFromArray(array $array)
		{
			$returnString = "<?php\n\treturn array(\n";
			//self::$recursionLevel = 0;	// initialise recursion level value
			$returnString .= self::recurse($array);
			$returnString .= "\n\t);";
			return $returnString;
		}

		public static function recurse(array $array)
		{
			$returnString = "";
			
			self::$recursionLevel++;
			foreach ($array as $key => $value)
			{
				/** Evaluate KEY **/
				if (is_string($key))
					$returnString .= self::getCurrentIndentation () . "'$key' => ";
				elseif($key === 0) {	// Start of an unindexed array
					$returnString .= implode(', ', $array);
					break;
				} else
					$returnString .= self::getCurrentIndentation () . $key . ' => ';

				/** Evaluate VALUE **/
				if (is_string($value))
				{
					$returnString .= "'$value'\n";
				}
				elseif (is_array($value)) {
					$returnString .= "array(\n";
					$returnString .= self::recurse($value);
					$returnString .= self::getCurrentIndentation() . "),\n";
				}
				else
					$returnString .= $value . "\n";
			}
			self::$recursionLevel--;
			return $returnString;
		}

		protected static function getCurrentIndentation()
		{
			$returnString = "\t";
			for($i=0; $i<self::$recursionLevel; ++$i)
				$returnString .= "\t";
			return $returnString;
		}

	}

}