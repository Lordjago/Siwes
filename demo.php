<?php 
	//require 'libraries/controller.php';
	// echo $_SESSION['staff'];
	// 	echo $_SESSION['admin'];
	// 		echo $_SESSION['mat_no'];
if (isset($_POST['go'])) {
	$enc = md5($_POST['password']);
	echo "<h1>".$enc."</h1>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		footer{
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
			background-color: red;
			color: white;
			text-align: center;
		}
	</style>
</head>
<body>
	<form method="POST" action="">
	<input type="text" name="password">
	<input type="submit" name="go" value="Go">
	</form>
	<footer>Helo here</footer>
</body>
</html>