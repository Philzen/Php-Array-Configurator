<?php

	include '../../library/PhpArrayConfigurator/ConfigFile.php';
	include '../../library/PhpArrayConfigurator/CodeCooking/PhpArrayFile.php';

	$configFile = new \PhpArrayConfigurator\ConfigFile('asset/test.conf.php');
	$configFile->save('asset/testresult1.conf.php');

	$configFile = new \PhpArrayConfigurator\ConfigFile('asset/testresult1.conf.php');
	$configFile->save('asset/testresult2.conf.php');

