<!DOCTYPE html>
<html>
<head>
	<title>File Upload</title>
</head>
<body>
	<?php 
  require 'libraries/connection/config.php';
  include 'libraries/functions/functions.php';
  include 'includes/template/header.php';
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                  //file_read($_FILES);
                    $ext_error = false;
                    $ext = array('pdf', 'doc','docx');
                    $file_ext = explode('.', $_FILES['uploadfile']['name']);
                    $file_ext = end($file_ext);
                    file_read($file_ext);
                    if (in_array($file_ext, $ext)){
                        $name = $_FILES['uploadfile']['tmp_name'];
                        $file = file_get_contents($name);
                        $file = base64_decode($file);
                        //file_read($file
                        savefile($file);
                    }else{
                        echo 'No';
                    }
                        
		}
        		function file_read($data){
        			echo "<pre>";
        			print_r($data);
        			echo "</pre>";
        		}
                function savefile($file){
                   $query = "INSERT INTO file(file) VALUES ('$file')";
                   $run = run_query($query);
                    if ($run) {
                            echo "File Uploaded";
                displayfile();	
                    }else {
                            echo "Fial to Upload";
                    }
                }
	function displayfile(){
//		error_reporting(0);
		$query = "SELECT * FROM file";
                $run = run_query($query);
		while ($row = mysqli_fetch_array($query)) {
            echo '<h1>'.$row['file'].'</h1>';
			//echo '<img height="300" width="300" src="data:image;base64,'.$row[image].'">';

		}

        $dept[0] ='Computer Science';
        $dept[1] ='Education Science';
        $dept[2] ='ICS Science';
        file_read ($dept);
	}
    
	 ?>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="uploadfile">
        <div class="input-field col s12">
            <select>
               <?php for ($i=0; $i < 3 ; $i++) {?><option><?php 
            echo $dept[$i];}?></option>
              
            </select>
    <label>Materialize Select</label>
  </div>
		<button>Upload</button>
	</form>
    <script type="text/javascript">
          $(document).ready(function(){
    $('select').formSelect();
  });
    </script>
</body>
</html>