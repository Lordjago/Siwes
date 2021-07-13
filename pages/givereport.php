<?php 
	require '../libraries/controller.php';
  session_start();
   if (!$_SESSION['mat_no']) {
      header('location:../index.php');
    }
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$report = $_POST['report'];
		$mat_no = strtoupper($_SESSION['mat_no']);
    $time = time();
    $reg_date = date('Y-m-d H:i:s', $time);
    $query = "SELECT * FROM applicants WHERE mat_no = '$mat_no'";
     $run = run_query($query);
     confirm($run);
    if ($row = mysqli_fetch_array($run)) {
      $lect_id = $row['assign_lect_id'];
		if (getimagesize($_FILES['image']['tmp_name'])==false)
			{
				echo "<script>swal('Error', 'Please Upload an Image','error');</script>";
			}else
			{
			$name = addslashes($_FILES['image']['name']);
			$type = addslashes($_FILES['image']['type']);
			$size = addslashes($_FILES['image']['size']);
			$image = addslashes($_FILES['image']['tmp_name']);
			$image =file_get_contents($image);
			$image=base64_encode($image);
			echo insert_report($report,$image,$mat_no,$reg_date,$lect_id);
			}
}
}
 ?>
	<title>Submit Report</title>
	<style type="text/css">
		#nav{
      background-image: url(../assets/image/footer.jpg);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
			/*background: #092756;
        background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
        background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
        background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
        background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);*/
		}
	</style>
</head>
<body><!--  onload='swal({
  text: "<?php first_name($_SESSION['mat_no']);?>"
})'  -->
	<nav class="navbar-fixed" id="nav">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo" style="margin-left: 30px;">SIWES Report System</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li>Lecture Assigned: - <?php echo staff();?></li>
        <li><a href="#"><?php echo "Student Matric Number: - ".strtoupper($_SESSION['mat_no']); ?></a></li>
        <li><a onclick=(logout())>Logout</a></li>
      </ul>
    </div>
  </nav>
    <div class="row">
    	<form method="POST" action="" enctype="multipart/form-data" class="center">
      <div class="col s12" style="margin-top: 25px;"> 
          <h6 class="left light-blue-text darken-2">Submit Your Weekly Workdone For Accessment</h6>
          <textarea class="col 12" type="text" name="report"style="height: 400px;" placeholder="Insert Report"></textarea> 
          <!-- <textarea  name="report" > -->  
      </div>
      <div class="col s12" style="margin-top: 60px;">
    		<div class="file-field input-field"">
      		<div class="btn" style="background-image: url(../assets/image/footer.jpg);">
        	<span>Upload File</span>
        	<input type="file" name="image">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
      </div>
      	<button class="btn center teal" style="margin-bottom: 90px; margin-left: 40px;background-image: url(../assets/image/footer.jpg);">Submit</button>
       </form>
      <div class="col s12">
      	<h6 class="center light-blue-text darken-2">

      		Lectures Comments
      	</h6><hr>
      	<?php 
      		echo read_staff_comment($_SESSION['mat_no']);
      	 ?>
      </div>
  <script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="../assets/js/materialize.min.js"></script>
  <script type="text/javascript"src="../assets/js/sweetalert.min.js"></script>
  <script type="text/javascript">
      function logout(){
            swal({
                    title: "Are you sure you want to logout?",
                    text: "Once logout, you will not be able to recover this session!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      window.location.assign('../logout.php');
                    } else {
                      return false;
                    }
                  });
      }
  </script>

