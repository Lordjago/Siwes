<?php 
	require'includes/controller.php';
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
    <p class="left"><strong>Hello, <em><?php if (admin_loggedin()) {
     echo admin_first_name($_SESSION['admin']); 
    }elseif (staff_loggedin()) {
      echo staff_first_name($_SESSION['staff']);
    } ?></em></strong></p>
    <p style="margin-bottom: 10px; margin-right: 30px;" class="right">Views/Students</p>	 
  </div>
  <hr>
  <?php
             echo "<table class='responsive-table centered'>
                     <thead>
                   <tr class ='grey-text ligthen-1'>
                    <th>S/N</th>
                    <th>Matric Number</th>
                    <th>Picture</th>
                    <th>Report</th>
                    <th>Time Submitted</th>
                    <th>View</th>
                  </tr>
                    </thead>";
                                  
          //while ($i > 1) {
            $session = $_SESSION['staff'];
            $query = "SELECT * FROM staff WHERE staffid = '$session'";
            $run = run_query($query);
            confirm($run);
            if ($row = mysqli_fetch_array($run)) {
                $lect_id = $row['lect_id'];
                $query = "SELECT * FROM student_report WHERE lect_id = '$lect_id'";
                $run = run_query($query);
                confirm($run);
            while ($row = mysqli_fetch_array($run)) {
              $time = $row['time'];
              $time = strtotime($time);
    	          echo "<tbody><tr>";
    	          echo "<td>" . $row['id'] . "</td>";
    	          echo "<td>" . strtoupper($row['mat_no']) . "</td>";
    	          echo '<td><img class="circle" style="width:30px; height:30px;" src="data:image;base64,'.$row['image'].'"></td>';
    	          echo "<td><p>" . $row['report'] . "</p></td>";?>
                <td><?php echo time_Ago($time); ?></td>
                <?php echo "<td><a href='view.php?id=".$row['mat_no']."&action=view'class='blue-text lighten-1'><i class='material-icons'>rate_review</i></a>"."</td>";
              	echo "</tr></tbody>";
          }
          }
          echo "</table>";
          ?> 
</main>
<?php 
      include '../includes/template/footer.php';
 ?>