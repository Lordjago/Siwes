<?php 
	require'includes/controller.php';
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$first_name = protect($_POST['first_name']);
		$last_name = protect($_POST['last_name']);
		$email = protect($_POST['email']);
		$staffId = protect($_POST['staffId']);
	  	$password = protect($_POST['password']);
	  	$role = protect($_POST['role']);
	  	$gender = protect($_POST['gender']);
		  if (getimagesize($_FILES['image']['tmp_name'])==false)
		  {
		    echo "<script>swal('Oops!', 'Please Upload an Image','error');</script>";
		    location('dashboard.php');
		  }else{
		  $name = addslashes($_FILES['image']['name']);
		  $type = addslashes($_FILES['image']['type']);
		  $size = addslashes($_FILES['image']['size']);
		  $image = addslashes($_FILES['image']['tmp_name']);
		  $image =file_get_contents($image);
		  $image=base64_encode($image);
		  saveimage($first_name, $last_name, $email, $staffId, $password, $role, $gender,$image);
		  } 
		    // if (empty($first_name) || empty($last_name) || empty($password) ||empty($email)){
		    //   echo "<script>swal('Oops!', 'You are Expected to fill out all the above credentials','error');</script>";
		    // }
		}
  function saveimage($first_name, $last_name, $email, $staffId, $password, $role, $gender,$image){
      include '../config.php';
      $query = mysqli_query($connect,"INSERT INTO admin_login(username,password,email,image) VALUES ('$username','$password','$email','$image')");
    if ($query) {
      echo "<script>swal('Success', 'Admin Added Successfully!!','success');</script>";
    }else {
    echo "<script>swal('Oops!', 'Failed','error');</script>";
  }
		}
 ?>