<?php
	$ErrorMsgs = array();
	$DBConnect = new mysqli("localhost", "root", "", "test");
	
	if (!$DBConnect)
		$ErrorMsgs[] = "The database server is not available";
?>