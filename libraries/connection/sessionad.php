<?php 
	session_start();
	if (!$_SESSION['staff']) {
		header('location:../index.php');
	}
	 ?>