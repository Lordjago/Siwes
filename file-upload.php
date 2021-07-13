<!DOCTYPE html>
<html>
<head>
	<title>File Upload</title>
</head>
<body>
	<?php 
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			file_read($_FILES);
		}
		function file_read($data){
			echo "<pre>";
			print_r($data);
			echo "</pre>";
		}
	 ?>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="uploadfile">
		<button>Upload</button>
	</form>
</body>
</html>