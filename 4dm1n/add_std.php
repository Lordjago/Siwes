<?php 
		require'includes/controller.php';
	if ($_SERVER['REQUEST_METHOD'] ==='POST') {
        $first_name = protect(strtoupper($_POST['first_name']));
        $last_name = protect($_POST['last_name']);
        $mat_no = protect(strtoupper($_POST['mat_no']));
        $email = $mat_no.'@students.edu.ng';
        $password = protect($_POST['password']);
        $faculty = protect($_POST['faculty']);
        $department = protect($_POST['department']);
        $programme = protect($_POST['programme']);
        $level = protect($_POST['level']);
        $gender = protect($_POST['gender']);
        if ($faculty === 'Education') {
          $edu_dept = array(
                'ET' => 'Educational Technology',
                'SC' => 'Science Education',
                'AE' => 'Art Education'
                );
          if (in_array($department, $edu_dept)) {
            if ($department  === $edu_dept['ET']) {
              $dept_prog = array(
                      'PJ' => 'Computer Science Education',
                      'PC' => 'Educational Technology'
                      );
              if (in_array($programme, $dept_prog)) {
              		$assign_lect_id = 1;
                    add_std($_POST, $assign_lect_id);
              }else{
                echo "<script>swal('Error', '".$programme." as a programme does not belong to the department of ".$department.".','error');</script>";
              }
            }else if ($department  === $edu_dept['SC']) {
              $dept_prog = array(
                      'PA' => 'Biology Education',
                      'PB' => 'Chemistry Education'
                      );
              if (in_array($programme, $dept_prog)) {
                    $assign_lect_id = 2;
                    add_std($_POST, $assign_lect_id);
              }else{
                echo "<script>swal('Error', '".$programme." as a programme does not belong to the department of ".$department.".','error');</script>";
              }
            }else if ($department === $edu_dept['AE']){
              $dept_prog = array(
                      'PJ' => 'Computer Science Education',
                      'PC' => 'Educational Technology'
                      );
              if (in_array($programme, $dept_prog)) {
                    $assign_lect_id = 3;
                    add_std($_POST, $assign_lect_id);
              }else{
                echo "<script>swal('Error', '".$programme." as a programme does not belong to the department of ".$department.".','error');</script>";
              }
            }
          }else{
            echo "<script>swal('Error', '".$department." does not belong to the faculty of ".$faculty.".','error');</script>";
          } 
        }else if ($faculty === 'Life Science') {
          $life_dept = array(
                'BC' => 'Biochemistry',
                'MB' => 'Microbiology'
                );
          if (in_array($department, $life_dept)) {
            if ($department  === $life_dept['BC']) {
              $dept_prog = array(
                      'BC' => 'Biochemistry'
                      );
              if (in_array($programme, $dept_prog)) {
                    $assign_lect_id = 1;
                    add_std($_POST, $assign_lect_id);
              }else{
                echo "<script>swal('Error', '".$programme." as a programme does not belong to the department of ".$department.".','error');</script>";
              }
            }else if ($department  === $life_dept['MB']) {
              $dept_prog = array(
                      'MB' => 'Microbiology'
                      );
              if (in_array($programme, $dept_prog)) {
                    $assign_lect_id = 7;
                    add_std($_POST, $assign_lect_id);
              }else{
                echo "<script>swal('Error', '".$programme." as a programme does not belong to the department of ".$department.".','error');</script>";
              }
            }
            }else{
            echo "<script>swal('Error', '".$department." does not belong to the faculty of ".$faculty.".','error');</script>";
          } 
        }
  }
 ?>
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
    <p style="margin-bottom: 10px; margin-right: 30px;" class="right">Add Student</p>   
  </div>
  <hr>
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
     </main>
    <script type="text/javascript">
      $(document).ready(function(){
      $('select').formSelect();
  });
    </script> 
    <?php 
      include '../includes/template/footer.php';
 ?>