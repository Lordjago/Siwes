<?php 
	session_start();
	function std_loggedin(){
		if (isset($_SESSION['mat_no'])) {
			return true;
		}
		else {
			return false;
		}
	}
	function staff_loggedin(){
		if (isset($_SESSION['staff'])) {
			return true;
		}
		else {
			return false;
		}
	}

	function admin_loggedin(){
		if (isset($_SESSION['admin'])) {
			return true;
		}
		else {
			return false;
		}
	}
	 ?>