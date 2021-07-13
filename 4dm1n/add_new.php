<?php 
	require'includes/controller.php';
	if (isset($_GET['r_val'])) {
		$add_new = base64_decode($_GET['r_val']);
	}
	if (isset($_POST['admin'])) { ?>
		<script>
			swal('Admin')
			.then((value) =>{
				window.location = 'add_new.php?r_val=QWRtaW4=';
				});
		</script>
	<?php } ?>

 <style type="text/css">
 body{
  background: #eceff1;
 }
   .card-panel{
    height: 130px;
   }
 </style>
 <body>
 <main style="margin-left: 15px; margin-top: 20px; margin-bottom: 120px;">
  <div class="row">
    <p class="left"><strong>Hello, <em><?php echo admin_first_name($_SESSION['admin']); ?></em></strong></p>
    <p style="margin-bottom: 10px; margin-right: 30px;" class="right">Add <?php echo $add_new; ?></p>   
  </div>
  <hr>
 	<?php 
 		if ($add_new === 'Admin') {?>
		<div class="row">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
          <div class="input-field col s6">
            <input type="text" class="validate" name="first_name" value="<?php echo $first_name;?>" autofocus>
            <label>First Name</label><br><br>
        </div>
          <div class="input-field col s6">
          <input type="text" class="validate" name="other_name" value="<?php echo $other_name;?>">
          <label>Last Name</label><br><br>
        </div>
        <div class="input-field col s6">
          <input type="text" class="validate" name="email" value="<?php echo $email;?>">
          <label>Email</label><br><br>
        </div>
        <div class="input-field col s6">
          <input type="text" class="validate" name="staffid" value="<?php echo $staffid;?>">
          <label>Staff ID</label><br><br>
        </div>
        <div class="input-field col s6">
          <input type="text" class="validate" name="password" value="<?php echo $password;?>">
          <label>Password</label>
        </div>
        <div class="input-field col s6">
         <select name="faculty">
            <option disabled selected>Choose Faculty</option>
            <option disabled selected>Super Admin</option>
          
        </select>
        <label>Role</label>
        </div>
        <div class="input-field col s6">
         <select name="gender">
          <option>Male</option>
          <option>Female</option>
         </select>
         <label>Gender</label>
        </div>
        <div class="input-field col s6">
        <div class="file-field input-field center">
        <div class="btn" style="background:#033560;">
        <span>Upload Image</span>
        <input type="file" name="image">
        </div>
         <div class="file-path-wrapper">
        <input class="file-path validate" type="text" name="image">
      </div>
    </div>
  </div>
        <div class="col s12 center">   
          <button class="btn waves-effect waves-light center white-text" style="background:#033560; border-radius: 3px; margin-top: -10px;" name="admin">Submit</button>
        </div>   
        <div class="col s1"></div>
      </form>
      </div> 
           </div>
         </div>
		<?php }else if ($add_new === 'Staff') {?>
		<div class="row">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
          <div class="input-field col s12">
            <input type="text" class="validate" name="lect_name" value="<?php echo $lect_name;?>" autofocus>
            <label>Full Name</label><br><br>
        </div>
          <div class="input-field col s6">
          <input type="text" class="validate" name="staffid" value="<?php echo $staffid;?>">
          <label>Staff ID</label><br><br>
        </div>
        <div class="input-field col s6">
          <input type="text" class="validate" name="password" value="<?php echo $password;?>">
          <label>Password</label><br><br>
        </div>
        <div class="input-field col s6">
            <input type="text" class="validate" name="email" value="<?php echo $email;?>" autofocus>
            <label>Email</label><br><br>
        </div>
        <div class="input-field col s6">
            <input type="text" class="validate" name="phone" value="<?php echo $phone;?>" autofocus>
            <label>Phone Number</label><br><br>
        </div>
        <div class="input-field col s6">
         <select name="gender">
          <option>Mr</option>
          <option>Mrs</option>
          <option>Dr</option>
          <option>Prof</option>
         </select>
         <label>Title</label>
        </div>
        <div class="input-field col s6">
         <select name="gender">
          <option>Male</option>
          <option>Female</option>
         </select>
         <label>Gender</label>
        </div>
        <div class="input-field col s6">
         <select name="faculty">
            <option disabled selected>Choose Faculty</option>
          <?php 
            $query="SELECT * FROM faculty";
            $run = run_query($query);
            confirm($run);
              while ($row=mysqli_fetch_array($run)) {
                  echo "<option>".$row['faculty']."</option>";
                }
          ?>
        </select>
        <label>Faculty</label>
        </div>
        <div class="input-field col s6">
          <select name="department">
            <option disabled selected>Choose Department</option>
            <?php
            $query="SELECT * FROM department";
            $run = run_query($query);
            confirm($run);
              while ($row=mysqli_fetch_array($run)) {
                  echo "<option>".$row['department']."</option>";
                }
          ?>
         </select>
         <label>Department</label>
        </div>
        <div class="col s12 center">   
          <button class="btn waves-effect waves-light center white-text" style="background:#033560; border-radius: 3px; margin-top: -20px;" name="submit" onclick="click()">Submit</button>
        </div>   
        <div class="col s1"></div>
      </form>
      </div> 
           </div>
         </div>
		<?php }else if ($add_new === 'Student') {?>
		<div class="row">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
          <div class="input-field col s12">
            <input type="text" class="validate" name="first_name" value="<?php echo $first_name;?>" autofocus>
            <label>First Name</label><br><br>
        </div>
          <div class="input-field col s6">
          <input type="text" class="validate" name="last_name" value="<?php echo $last_name;?>">
          <label>Last Name</label><br><br>
        </div>
        <div class="input-field col s6">
          <input type="text" class="validate" name="mat_no" value="<?php echo $mat_no;?>">
          <label>Matric Number</label><br><br>
        </div>
        <div class="input-field col s6">
          <input type="text" class="validate" name="password" value="<?php echo $password;?>">
          <label>Password</label>
        </div>
        <div class="input-field col s6">
         <select name="faculty">
            <option disabled selected>Choose Faculty</option>
          <?php 
            $query="SELECT * FROM faculty";
            $run = run_query($query);
            confirm($run);
              while ($row=mysqli_fetch_array($run)) {
                  echo "<option>".$row['faculty']."</option>";
                }
          ?>
        </select>
        <label>Faculty</label>
        </div>
        <div class="input-field col s6">
          <select name="department">
            <option disabled selected>Choose Department</option>
            <?php
            $query="SELECT * FROM department";
            $run = run_query($query);
            confirm($run);
              while ($row=mysqli_fetch_array($run)) {
                  echo "<option>".$row['department']."</option>";
                }
          ?>
         </select>
         <label>Department</label>
        </div>
        <div class="input-field col s6">
          <select name="programme">
            <option disabled selected>Choose Programme</option>
            <?php
            $query="SELECT * FROM programme";
            $run = run_query($query);
            confirm($run);
              while ($row=mysqli_fetch_array($run)) {
                  echo "<option>".$row['programme']."</option>";
                }
          ?>
         </select>
         <label>Programme</label>
        </div>
        <div class="input-field col s6">
        <select name="level">
          <?php
            for ($i=300; $i <=400 ; $i=$i+100) { 
              echo "<option>".$i."</option>";
            }
          ?>
        </select>
      <label id="label">Level</label><br>
      </div>
        <div class="input-field col s6">
         <select name="gender">
          <option>Male</option>
          <option>Female</option>
         </select>
         <label>Gender</label>
        </div>
        <div class="col s12 center">   
          <button class="btn waves-effect waves-light center white-text" style="background:#033560; border-radius: 3px; margin-top: -30px;" name="submit" onclick="click()">Submit</button>
        </div>   
        <div class="col s1"></div>
      </form>
      </div> 
           </div>
         </div>
			
		<?php }

 	 ?>
     </main>
    <script type="text/javascript">
   $(document).ready(function(){
    $('select').formSelect();
  });
    </script> 
    <?php 
      include '../includes/template/footer.php';
 ?>