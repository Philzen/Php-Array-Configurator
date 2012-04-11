<?php

namespace PhpArrayConfigurator
{
	class ConfigFile
	{
		protected $configArray = null;
		protected $originalFilePath = null;

		public function __construct($filePath = null)
		{
			if ($filePath !== null)
				$this->open ($filePath);
		}

		public function open($filePath)
		{
			$this->originalFilePath = $filePath;
			if (file_exists($filePath)) {
				$this->configArray = include $filePath;
				return true;
			}
			else
				return false;
		}

		/**
		 *
		 * @return array Content of the open file as a php array,
		 * or FALSE if file has not been successfully loaded before
		 */
		public function getArray()
		{
			if (null !== $this->configArray)
				return $this->configArray;

			return false;
		}

		public function setArray(array $array)
		{
			$this->configArray = $array;
			return $this;
		}

		public function save()
		{
			var_dump(CodeCooking\PhpArrayFile::getFromArray($this->configArray));

			return $this;
		}




	}
}