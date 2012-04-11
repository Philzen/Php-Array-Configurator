<?php

namespace PhpArrayConfigurator\CodeCooking
{
	/**
	 * Static Helper Class to perform array to PHP code conversion
	 */
	class PhpArrayFile
	{
		protected static $recursionLevel = 0;

		/**
		 * @param array $array The array to convert to PHP code. CAUTION: The array may contain any nested combination keys, values and arrays, BUT IT MUST NOT contain a value with the integer index 0 (String Value '0' and unindexed arrays are allowed).
		 * @return string
		 */
		public static function getFromArray(array $array)
		{
			$returnString = "<?php\n\treturn array(\n";
			//self::$recursionLevel = 0;	// initialise recursion level value
			$returnString .= self::recurse($array);
			$returnString .= "\n\t);";
			return $returnString;
		}

		protected static function recurse(array $array)
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