 <?php 
	require'includes/controller.php';
 ?>
          <style type="text/css">
          body{
          	background: #eceff1;
          }
          	h6{
          		/*text-shadow: 0 0 3px #FF0000, 0 0 5px #0000FF;*/
          		color: white;
    			text-shadow: 1px 1px 2px black, 0 0 25px blue, 0 0 5px darkblue;
          		text-align: center;
          		margin-top: 40px;
          		font-size: 18px;
          		margin-bottom: 40px;
          	}
          </style>
  <main style="margin-left: 15px; margin-top: 20px;">
  <div class="row">
    <hr>
    <p class="left"><strong>Hello, <em><?php echo admin_first_name($_SESSION['admin']); ?></em></strong></p>
    <p style="margin-bottom: 10px; margin-right: 30px;" class="right">Emails</p>	 
  </div>
  <hr>
          <h6>The Emails and Password of all Lecturers and Students are given below: -</h6>
          <a onclick="" class="btn indigo lighten-3">Export to CVS</a>
          <?php 
	  		$query = "SELECT * FROM administrator";
	  		$run = run_query($query);
	  		$query = "SELECT * FROM staff";
	  		$run1 = run_query($query);
	  		$query = "SELECT * FROM applicants";
	  		$run2 = run_query($query);
             echo "<table class='responsive-table' style='margin-left:30px;'>
                   <thead>
                   <tr class ='grey-text ligthen-1'>
                  
                    <th>Emails</th>
                    <th>Role</th>
                    <th>ID</th>
                    <th>Password</th>
                    </tr>
                  </thead>";

          while($row = mysqli_fetch_array($run))
          { 
	          	echo "<tbody><tr>";
	          	// echo "<td>" . $row['id'] . "</td>";
            	echo "<td>" . $row['email'] . "</td>";
            	echo "<td>" . $row['role'] . "</td>";
            	echo "<td>" . $row['staffid'] . "</td>";
	         	echo "<td>" . $row['password']. "</td>";}
	         while ($row = mysqli_fetch_array($run1)) {
	         	$role = 'Lecturer';
	         	echo "<tr>";
	         	// echo "<td>" . $row['id'] . "</td>";
            	echo "<td>" . $row['email'] . "</td>";
            	echo "<td>" . $role . "</td>";
            	echo "<td>" . $row['staffid'] . "</td>";
	         	echo "<td>" . $row['password']. "</td>";}
	         
	          while ($row = mysqli_fetch_array($run2)) {
	          	$role ='Student';
	         	echo "<tr>";
	         	// echo "<td>" . $row['id'] . "</td>";
	         	echo "<td>" . $row['email'] . "</td>";
            	echo "<td>" . $role . "</td>";
            	echo "<td>" . $row['mat_no'] . "</td>";
	         	echo "<td>" . $row['password']. "</td>";
		       	echo "</tr></tbody>";
         
          }
            
          echo "</table>";
          ?>
</main>
<?php 
      include '../includes/template/footer.php';
 ?> 