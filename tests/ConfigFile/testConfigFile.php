<?php

	include '../library/PhpArrayConfigurator/ConfigFile.php';
	include '../library/PhpArrayConfigurator/CodeCooking/PhpArrayFile.php';

	$configFile = new \PhpArrayConfigurator\ConfigFile('test.conf.php');

	var_dump($configFile);

	$configFile->save();