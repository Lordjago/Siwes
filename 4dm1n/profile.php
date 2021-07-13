 <?php 
	require'includes/controller.php';
 ?>
          <style type="text/css">
          body{
          	background: #eceff1;
          }
          .img{
            width: 60px; height: 60px; margin-right:30px; margin-top: 10px;
          }
          </style>
<main style="margin-left: 15px; margin-top: 20px; margin-bottom: 100px;">
  <div class="row">
    <hr>
    <p class="left"><strong>Hello, <em><?php if (admin_loggedin()) {
      echo admin_first_name($_SESSION['admin']); 
    }elseif (staff_loggedin()) {
      echo staff_first_name($_SESSION['staff']);
    } ?></em></strong></p>
    <p style="margin-bottom: 10px; margin-right: 30px;" class="right">Profile</p>	 
  </div>
  <hr>
     <div class="row">
      <div class="col s12 m3"></div>
      <div class="col s12 m6">
        <div class="card">
          <div class="card-image">
            <img src="../assets/image/acc.jpg">
            <span class="card-title"><?php
             $query = "SELECT *  FROM administrator WHERE staffid = '{$_SESSION['admin']}'";
             $run = run_query($query);
             confirm($run);
             if($row = mysqli_fetch_array($run)){ $fname = $row['first_name'];$oname = $row['other_names'];$staffid = $row['staffid'];$email = $row['email'];$gender = $row['gender'];$password = $row['password'];}
              echo $fname." ".$oname;
             ?></span>
          </div><img class="right img" src="../assets/image/totals.jpeg">
          <div class="card-content"><?php if (admin_loggedin()) {?>
            <ul>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Staff ID: - <?php echo $staffid; ?></strong></li>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Email: - <?php echo $email; ?></strong></li>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Gender: - <?php echo $gender; ?></strong></li>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Password:  <?php echo $password; ?></strong><li>
            </ul>
          <?php }else if (staff_loggedin()) { 
            $query = "SELECT *  FROM staff WHERE staffid = '{$_SESSION['staff']}'";
             $run = run_query($query);
             confirm($run);
             if($row = mysqli_fetch_array($run)){ $lname = $row['lect_name']; $staffid = $row['staffid'];$email = $row['email'];$gender = $row['gender'];$password = $row['password'];$faculty = $row['faculty'];$department = $row['department'];}
              
            ?>
            <span class="card-title"><?php echo $lname; ?></span>
            <ul>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Staff ID: - <?php echo $staffid; ?></strong></li>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Faculty: - <?php echo $faculty; ?></strong></li>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Department: - <?php echo $department; ?></strong></li>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Email: - <?php echo $email; ?></strong></li>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Gender: - <?php echo $gender; ?></strong></li>
              <li style="margin-bottom: 10px; color:#43a047;"><strong>Password:  <?php echo $password; ?></strong><li>
            </ul>
          <?php } ?>
          </div>
        </div>
      </div>
      <div class="col s12 m3"></div>
  </div>
</main>
<?php 
      include '../includes/template/footer.php';
 ?> 