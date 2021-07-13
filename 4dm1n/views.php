<?php 
	require'includes/controller.php';
	if (isset($_GET['r_val'])) {
		$list_view = base64_decode($_GET['r_val']);
	}
 ?>
 <style type="text/css">
 body{
  background: #eceff1;
 }
   .card-panel{
    height: 130px;
   }
   .button {
    background-color: #4db6ac;
    border-radius: 4px;
    border-style: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
 </style>
 <body>
 <main style="margin-left: 15px; margin-top: 20px; margin-bottom: 120px;">
  <div class="row">
    <p class="left"><strong>Hello, <em><?php if (admin_loggedin()) {
      echo admin_first_name($_SESSION['admin']); 
    }elseif (staff_loggedin()) {
      echo staff_first_name($_SESSION['staff']);
    }  ?></em></strong></p>
    <p style="margin-bottom: 10px; margin-right: 30px;" class="right">View <?php echo $list_view; ?></p>   
  </div>
  <hr>
 	<?php 
 		if ($list_view === 'Admin') {
      $query = "SELECT * FROM administrator";
      $run = run_query($query);
             echo "<table class='responsive-table center'>
                     <thead>
                   <tr class ='grey-text ligthen-1'>
                    <th>S/N</th>
                    <th></th>
                    <th>Fullname</th>
                    <th>Staff ID</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Gender</th>
                    </tr>
                  </thead>";


          while($row = mysqli_fetch_array($run))
          { 
            echo "<tbody><tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td><p><label><input type='checkbox'/><span></span></label></p></td>";
            echo "<td><strong>". strtoupper($row['first_name']) .", </strong><br>".$row['other_names'] . "</td>";
            echo "<td>" . $row['staffid'] . "</td>";
            echo "<td>" . $row['password']. "</td>";
            echo "<td>" . $row['role'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
              echo "</tr></tbody>";
          
          }    
          echo "</table>";
        }else if ($list_view === 'Staff') {
          $query = "SELECT * FROM staff";
      $run = run_query($query);
             echo "<table class='responsive-table centered'>
                     <thead>
                   <tr class ='grey-text ligthen-1'>
                    <th>S/N</th>
                    <th></th>
                    <th>Lecturer ID</th>
                    <th>Fullname</th>
                    <th>Staff ID</th>
                    <th>Password</th>
                    <th>Faculty</th>
                    <th>Department</th>
                    <th>Title</th>
                    <th>Gender</th>
                    <th>Date Registered</th>
                    </tr>
                  </thead>";


          while($row = mysqli_fetch_array($run))
          { 
            echo "<tbody><tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td><p><label><input type='checkbox'/><span></span></label></p></td>";
            echo "<td>" . $row['lect_id'] . "</td>";
            echo "<td>" . $row['lect_name'] . "</td>";
            echo "<td>" . $row['staffid'] . "</td>";
            echo "<td>" . $row['password']. "</td>";
            echo "<td>" . $row['faculty'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "</tr></tbody>";
          
          }    
          echo "</table>";
        }else if ($list_view === 'Student') {
            $query = "SELECT * FROM applicants";
            $run = run_query($query);
             echo "<table class='responsive-table centered'>
                     <thead>
                   <tr class ='grey-text ligthen-1'>
                    <th>S/N</th>
                    <th></th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Matric ID</th>";
              if (admin_loggedin()) {
                echo "<th>Password</th>
                      <th>Faculty</th>
                      <th>Department</th>
                      <th>Gender</th>
                      <th>Lecturer ID</th>
                      <th>Edit</th>
                      </tr>
                    </thead>";
              }else{
                echo "<th>Faculty</th>
                      <th>Department</th>
                      <th>Gender</th>
                      </tr>
                    </thead>";
              }
    if (admin_loggedin()) {
          while($row = mysqli_fetch_array($run))
          { 
            echo "<tbody><tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td><p><label><input type='checkbox'/><span></span></label></p></td>";
            echo "<td><strong>". strtoupper($row['first_name']) .", </strong><br>".$row['last_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . strtoupper($row['mat_no']) . "</td>";
            echo "<td>" . $row['password']. "</td>";
            echo "<td>" . $row['faculty'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['assign_lect_id'] . "</td>";
            echo "<td><a href='edit.php?id=".$row['mat_no']."&action=edit'class='blue-text lighten-1'><i class='material-icons'>edit</i></a>"."</td>";
            echo "</tr></tbody>";
          }
          }else if (staff_loggedin()) {
            $session = $_SESSION['staff'];
            $query = "SELECT * FROM staff WHERE staffid = '$session'";
            $run = run_query($query);
            confirm($run);
            if ($row = mysqli_fetch_array($run)) {
                $lect_id = $row['lect_id'];
                $query = "SELECT * FROM applicants WHERE assign_lect_id = '$lect_id'";
                $run = run_query($query);
                confirm($run);
              while ($row = mysqli_fetch_array($run)) {
                echo "<tbody><tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td><p><label><input type='checkbox'/><span></span></label></p></td>";
                echo "<td><strong>". strtoupper($row['first_name']) .", </strong><br>".$row['last_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . strtoupper($row['mat_no']) . "</td>";
                echo "<td>" . $row['faculty'] . "</td>";
                echo "<td>" . $row['department'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "</tr></tbody>";
            }    
          }
        }
          echo "</table>";
        }else{
          header('location:dashboard.php');
        }
   ?>   
         <!--  <div class="row">
              <div class="col s12" style="margin-left: 10px; margin-top: 50px;"><button class="button">Export to CSV</button></div>
          </div> -->
  
     </main>
    <script type="text/javascript">
      $(document).ready(function(){
      $('select').formSelect();
  });
    </script> 
    <?php 
      include '../includes/template/footer.php';
 ?>