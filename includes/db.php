<?php

	$db['db_host']='localhost';
	$db['db_user']='root';
	$db['db_pass']='';
	$db['db_name']='unicorn';

	foreach ($db as $key => $value) {
		define(strtoupper($key), $value);
	}

	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	if (!$con) {
		echo "<script>alert('Connection to database failed. Please contact sysadmin')</script>";
	}
?>