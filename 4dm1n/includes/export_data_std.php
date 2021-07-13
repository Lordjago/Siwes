<?php 
  require '../../libraries/connection/config.php';
  require '../../libraries/functions/functions.php';
if (isset($_POST['export_data'])) {    
    $output = '';
		$query = "SELECT * FROM applicants";
        $run = run_query($query);
        confirm($run);
        if ($run >0) {
            $output .='
            	   <table class="responsive-table centered">
                   <thead>
                   <tr class ="grey-text ligthen-1">
                    <th>S/N</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Matric ID</th>
                    <th>Password</th>
                    <th>Faculty</th>
                    <th>Department</th>
                    <th>Gender</th>
                    <th>Lecturer ID</th>
                    </tr>
                    </thead>';
  	 while($row = mysqli_fetch_array($run)){
           $output .='<tbody><tr>
			       <td>'. $row['id'] .'</td>
		           <td><strong>'.strtoupper($row['first_name']) .', </strong><br>'.$row['last_name'] .'</td>
		           <td>' . $row['email'] . '</td>
			       <td>'. strtoupper($row['mat_no']) .'</td>
			       <td>'. $row['password'].'</td>
			       <td>'. $row['faculty'] .'</td>
			       <td>'. $row['department'] .'</td>
		           <td>'. $row['gender'] .'</td>
		           <td>'. $row['assign_lect_id'] .'</td>
            		</tr></tbody>';
          }
          $output.='</table>';
          header('Content-Type: application/xls');
          header('Content-Disposition:attachment; filename=download.xls');
          echo $output;
         }
}	?>
