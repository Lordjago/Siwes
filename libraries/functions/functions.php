<?php 
	//To protect all input by the user from SQL Injection, truncate html tags and trim white spaces
	function protect($data){
		global $db;
		$data = $db->real_escape_string(htmlentities(trim($data)));
		return $data;
	}
	//To run the sql query
	function run_query($sql){
		global $db;
		$runs = mysqli_query($db, $sql);
		return $runs;
	}
	//Time
	function time_frame(){
		$time = time();
	    $real_date = date('h:i:s A', $time);
	    $real_time = date('d M, Y', $time);
	    // echo $real_date;
	   	// echo $real_time;
	}
	//Attempted Credential by Users
	function login_file_attempts($mat_no, $password, $status, $run){
		$handle = fopen('includes/paths.txt','a');
	    $time = time();
	    $real_date = date('h:i:s A', $time);
	    $real_time = date('d M, Y', $time);
	    $address = $_SERVER['REMOTE_ADDR'];
	    $num_row=mysqli_num_rows($run);
		if ($num_row === 1) {
			$status = 'Login Succesfull';
			$info = "\n\nNew Request made with the following credentials:\nMatric Number: - $mat_no \nPassword: - $password\nStatus: - $status\nAccess Date: - $real_time\nAccess Time: - $real_date\nRemote Address: - $address";
	    	$message = fwrite($handle, $info);
		}else{
			$status = 'Invalid Login Credential';
			$info = "\n\nNew Request made with the following credentials:\nMatric Number: - $mat_no \nPassword: - $password\nStatus: - $status\nAccess Date: - $real_time\nAccess Time: - $real_date\nRemote Address: - $address";
	    	$message = fwrite($handle, $info);
		}
	    
	}
	//Confrimis query runs
	function confirm($result){
		if (!$result) {
			die("<script>swal('Error', 'Contact Administrator','error');</script>");
		}
	}
	//Setting cookies for users
	function cookie(){
		setcookie('mat_no',$_POST['mat_no'], time()+(3600 * 24 * 7 * 365));
        setcookie('password',$_POST['password'], time()+(3600 * 24 * 7 * 365));
        // time()+(3600 * 24 * 7 * 365)
        return true;
	}
	//Un-setting  user cookie
	function cookie_unset(){
		if (isset($_COOKIE['mat_no'])) {
          setcookie('mat_no',"");
        }
        if (isset($_COOKIE['password'])) {
          setcookie('password',"");
        }
	}
	//Create session  for user if login successfull
	function create_sess(){
		session_start();
        $_SESSION['mat_no'] = $_POST['mat_no'];
        $_SESSION['password'] = $_POST['password'];
	}
	//Create session  for user if login successfull admin
	function create_sess_staff(){
		session_start();
        $_SESSION['staff'] = $_POST['mat_no'];
        $_SESSION['password'] = $_POST['password'];
	}	
	//Create session  for user if login successfull admin
	function create_sess_admin(){
		session_start();
        $_SESSION['admin'] = $_POST['mat_no'];
        $_SESSION['password'] = $_POST['password'];
	}	
	//Check row number to confirm if student is present
	function check_std($num){
		$num_row=mysqli_num_rows($num);
		if ($num_row === 1) {
			create_sess();
			header('location:pages/givereport.php');
		}else{
			$message = "<script>swal('Oops!!!', 'Invalid login credentials','error');</script>";
			return $message;
		}
	}
	//Check row number to confirm if staff is present
	function check_staff($num){
		$num_row=mysqli_num_rows($num);
		if ($num_row === 1) {
			//To create session for staff
			create_sess_staff();
			//To redirect staff to the dashboard
			header('location:4dm1n/dashboard.php?login=success');
		}else{
			$message = "<script>swal('Oops!!!', 'Invalid login credentials','error');</script>";
			return $message;
		}
	}
	//Check row number to confirm if admin is present
	function check_admin($num){
		$num_row=mysqli_num_rows($num);
		if ($num_row === 1) {
			//To create session for admin
			create_sess_admin();
			//To redirect admin to the dashboard
			header('location:4dm1n/dashboard.php?login=success');
		}else{
			$message = "<script>swal('Oops!!!', 'Invalid login credentials','error');</script>";
			return $message;
		}
	}
	//Check row number to confirm if lecturer is present
	function staff(){
		//Statement or SQL query to be execute
		$query = "SELECT * FROM applicants WHERE mat_no = '{$_SESSION['mat_no']}'";
		//To execute the query
		 $run = run_query($query);
		 //To check if the query runs
		 confirm($run);
		if ($row = mysqli_fetch_array($run)) {
		 	$lect_id = $row['assign_lect_id'];
		 	//Statement or SQL query to be execute
		 	 $query = "SELECT * FROM staff WHERE lect_id = '$lect_id'";
		 	//To execute the query
		 	$run = run_query($query);
		 	//To check if the query runs
		 	confirm($run);
  		 if ($rows = mysqli_fetch_array($run)) {
  			$message = "".$rows['title'].'. '.$rows['lect_name']."";
  			return $message;
		 }else{
		 	$message = "Contact Administrator";
		 	return $message;
		 }
		
		}
	}
	//To Collect the firstname of the session user students
	function first_name($session_mat_no){
		 //Statement or SQL query to be execute
		$query = "SELECT *  FROM applicants WHERE mat_no = '$session_mat_no'";
		 //To execute the query
		 $run = run_query($query);
		 //To check if the query runs
		 confirm($run);
       if($row = mysqli_fetch_array($run)){ $fname = $row['first_name'];}
        $message = 'Welcome! '.strtoupper($_SESSION['mat_no']).' - '.$fname;
        return $message;
	}
	//To Collect the firstname of the session user staff
	function staff_first_name($session_var){
		 //Statement or SQL query to be execute
		$query = "SELECT *  FROM staff WHERE staffid = '$session_var'";
		 //To execute the query
		 $run = run_query($query);
		 //To check if the query runs
		 confirm($run);
       if($row = mysqli_fetch_array($run)){ 
       	$row['title'];
       	$row['lect_name'];
       }
        $message = 'Welcome! '.$row['title'].'. '.$row['lect_name'];
        return $message;
	}
	//To Collect the firstname of the session user admin
	function admin_first_name($session_var){
		 //Statement or SQL query to be execute
		$query = "SELECT *  FROM administrator WHERE staffid = '$session_var'";
		 //To execute the query
		 $run = run_query($query);
		 //To check if the query runs
		 confirm($run);
       if($row = mysqli_fetch_array($run)){ $fname = $row['first_name'];}
        $message = 'Welcome! '.strtoupper($_SESSION['admin']).' - '.$fname;
        return $message;
	}
	//Authenticate students
	function auth_std($data){
		global $db;
	    $mat_no = protect(strtoupper($_POST['mat_no']));
	    $password = protect($_POST['password']);
	    //Statement or SQL query to be execute
	    $query = "SELECT mat_no, password FROM applicants WHERE mat_no ='$mat_no' AND password ='$password'";
	    //To execute the query
		$run = run_query($query);
		//To check if the query runs
		confirm($run);
	    echo check_std($run);
	    login_file_attempts($mat_no, $password,$status, $run);
	    cookie();
	}
	//Authenticate Staff
	function auth_staff($data){
		global $db;
		$username = protect(strtoupper($_POST['mat_no']));
		$password = protect(md5($_POST['password']));
		//Statement or SQL query to be execute
		$query = "SELECT * FROM staff WHERE staffid ='$username' AND password ='$password'";
		//To execute the query
		$run = run_query($query);
		//To check if the query runs
		confirm($run);
		echo check_staff($run);
		login_file_attempts($username, $password,$status, $run);
    	cookie();
	}
	//Authenticate Admin
	function auth_admin($data){
		global $db;
		$username = protect(strtoupper($_POST['mat_no']));
		$password = protect($_POST['password']);
		//Statement or SQL query to be execute
		$query = "SELECT * FROM administrator WHERE staffid ='$username' AND password ='$password'";
		//To execute the query
		$run = run_query($query);
		//To check if the query runs
		confirm($run);
		echo check_admin($run);
		login_file_attempts($username, $password,$status, $run);
    	cookie();
	}
	//Insert Student Report
	function insert_report($report,$image,$mat_no,$reg_date,$lect_id){
	//Statement or SQL query to be execute
		$query ="INSERT INTO student_report (report,image,mat_no,time,lect_id) VALUES ('$report','$image','$mat_no','$reg_date','$lect_id')";
		//To execute the query
		$run = run_query($query);
		//To check if the query runs
		confirm($run);
	 	if ($run) {
	 		$message = "<script>swal('Success', 'Report Submitted Successfully!!','success');</script>";
	 		return $message;
	 	}else if (empty($report)){
	      $message = "<script>swal('Oops!', 'You are Expected to Submit your report','error');</script>";
	      return $message;
	    }
	}
	//Get all admininistrator
	function get_admin(){
		//Statement or SQL query to be execute
		$query = "SELECT * FROM administrator";
        //To execute the query
        $run = run_query($query);
        //To check if the query runs
		confirm($run);
        $num_of_admin = mysqli_num_rows($run);
        $message = "<strong>".$num_of_admin."</strong>";
        return $message;
	}
		//Get all Staff/Lecturer
	function get_staff(){
		//Statement or SQL query to be execute
		$query = "SELECT * FROM staff";
        //To execute the query
        $run = run_query($query);
        //To check if the query runs
		confirm($run);
        $num_of_staff = mysqli_num_rows($run);
        $message = "<strong>".$num_of_staff."</strong>";
        return $message;
	}
		//Get all Students
	function get_std(){
		//Statement or SQL query to be execute
		$query = "SELECT * FROM applicants";
        //To execute the query
        $run = run_query($query);
        //To check if the query runs
		confirm($run);
        $num_of_std = mysqli_num_rows($run);
        $message = "<strong>".$num_of_std."</strong>";
        return $message;
	}
		//Get all Total
	function get_total(){
		//Statement or SQL query to be execute
		$query = "SELECT * FROM administrator";
        //To execute the query
        $run = run_query($query);
        $num_of_admin = mysqli_num_rows($run);
        //Statement or SQL query to be execute
        $query1 = "SELECT * FROM staff";
        //To execute the query
        $run1 = run_query($query1);
        $num_of_staff = mysqli_num_rows($run1);
        //Statement or SQL query to be execute
        $query2 = "SELECT * FROM applicants";
        //To execute the query
        $run2 = run_query($query2);
        $num_of_std = mysqli_num_rows($run2);
		$total = $num_of_admin + $num_of_staff + $num_of_std;
		$message = "<strong>".$total."</strong>";
		return $message;
	}
	//get total number of students under a staff
	function get_lect_std($session){
		//Statement or SQL query to be execute
		$query = "SELECT * FROM staff WHERE staffid = '$session'";
		//To execute the query
		$run = run_query($query);
		confirm($run);
		if ($row = mysqli_fetch_array($run)) {
			$lect_id = $row['lect_id'];
			//Statement or SQL query to be execute
			$query = "SELECT * FROM applicants WHERE assign_lect_id = '$lect_id'";
			//To execute the query
			$run = run_query($query);
			//To check if the query runs
			confirm($run);
			$num_of_std = mysqli_num_rows($run);
			$message = "<strong>".$num_of_std."</strong>";
			return $message;
		}
		
	}
	function get_lect_report($session){
		//Statement or SQL query to be execute
		$query = "SELECT * FROM staff WHERE staffid = '$session'";
		//To execute the query
		$run = run_query($query);
		confirm($run);
		if ($row = mysqli_fetch_array($run)) {
			$lect_id = $row['lect_id'];
			//Statement or SQL query to be execute
			$query = "SELECT * FROM student_report WHERE lect_id = '$lect_id'";
			//To execute the query
			$run = run_query($query);
			//To check if the query runs
			confirm($run);
			$num_of_std = mysqli_num_rows($run);
			$message = "<strong>".$num_of_std."</strong>";
			return $message;
		}
		
	}
	//Coverting php timestamp to time ago
	function time_Ago($time) { 
    // Calculate difference between current 
    // time and given timestamp in seconds 
    $time_diff     = time() - $time; 
    // Time difference in seconds 
    $second     = $time_diff; 
    // Convert time difference in minutes 
    $minutes     = round($time_diff / 60 ); 
    // Convert time difference in hours 
    $hours    = round($time_diff / 3600); 
    // Convert time difference in days 
    $days     = round($time_diff / 86400 ); 
    // Convert time difference in weeks 
    $weeks     = round($time_diff / 604800); 
    // Convert time difference in months 
    $months     = round($time_diff / 2600640 );
    // Convert time difference in years 
    $years     = round($time_diff / 31207680 ); 
    // Check for seconds 
    if($second <= 60) { 
        $message = "$second seconds ago"; 
        return $message;
    } 
    // Check for minutes 
    else if($minutes <= 60) { 
        if($minutes==1) { 
            $message = "1 minute ago"; 
            return $message;
        } 
        else { 
            $message = "$minutes minutes ago"; 
            return $message;
        } 
    } 
    // Check for hours 
    else if($hours<= 24) { 
        if($hours== 1) {  
            $message = "1 hour ago"; 
            return $message;
        } 
        else { 
            $message = "$hours hour ago"; 
            return $message;
        } 
    } 
    // Check for days 
    else if($days <= 7) { 
        if($days == 1) { 
            $message = "Yesterday"; 
            return $message;
        } 
        else { 
            $message = "$days days ago"; 
            return $message;
        } 
    } 
    // Check for weeks 
    else if($weeks <= 4.3) { 
        if($weeks == 1) { 
            $message = "A week ago"; 
            return $message;
        } 
        else { 
            $message = "$weeks weeks ago"; 
            return $message;
        } 
    } 
    // Check for months 
    else if($months <= 12) { 
        if($months == 1) { 
            $message = "A month ago"; 
            return $message;
        } 
        else { 
            $message = "$months months ago"; 
            return $message;
        } 
    }
    // Check for years 
    else { 
        if($years == 1) { 
            $message = "1 year ago"; 
            return $message;
        } 
        else { 
            $message = "$years years ago"; 
            return $message;
        } 
    } 
} 
//Insert Staff Comment
function staff_comment($userid, $comment){
	global $db;
	$tim = time();
  	$comm_time = date('Y-m-d H:i:s', $tim);
    //Statement or SQL query to be execute
    $query = "UPDATE student_report SET comment = '$comment', com_time = '$comm_time'  WHERE mat_no = '$userid'";
    //To execute the query
    $run = run_query($query);
    //To check if the query runs
    confirm($run);
    if ($run !== false) {
      $message = "<script>swal('Success', 'Comment Submitted!!','success');</script>";
      return $message;
    }else
      {
        $message = "<script>swal('Error', 'Failed to Submit!!','error');</script>";
        return $message;
      }
  }
  //Read Staff Comment of students portal
  function read_staff_comment($data){
  	//Statement or SQL query to be execute
  	$query = "SELECT * FROM student_report WHERE mat_no = '$data'";
    //To execute the query
  	$run =run_query($query);
  	//To check if the query runs
  	confirm($run);
  	if ($row = mysqli_fetch_array($run)) {
  		$comment = $row['comment'];
  		$comment = "<h6 class = 'blue-text lighten-2'>".$comment."</h6><br>";
  		$time = $row['com_time'];
  		$time = strtotime($time);
  		$time = time_Ago($time);
  		return $comment.=$time;
  	}
  }
  //Update students record
  function std_update($data){
  		global $db;
  		$first_name = protect(strtoupper($data['first_name']));
        $last_name = protect($data['last_name']);
        $mat_no = protect(strtoupper($data['mat_no']));
        $email = protect($data['email']);
        $password = protect($data['password']);
        $faculty = protect($data['faculty']);
        $department = protect($data['department']);
        $programme = protect($data['programme']);
        $level = protect($data['level']);
        $gender = protect($data['gender']);
	    $query = "UPDATE applicants SET first_name = '$first_name', last_name = '$last_name', mat_no = '$mat_no', email ='$email', password = '$password', faculty = '$faculty', department = '$department', programme = '$programme', level = '$level', gender = '$gender' WHERE mat_no = '$mat_no'";
		$run = run_query($query);
		confirm($run);
	    if ($run) {
	      echo "<script>swal('Success', 'Update Successful!!','success');</script>";
	      header('location:students.php');
	    }else{
	      	echo "<script>swal('Error', 'Failed!!','error');</script>";
	         header('location:students.php');
	      }
	  }
	function add_std($data, $assign_lect_id){
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
		$query = "INSERT INTO applicants (first_name, last_name, email, mat_no, password, faculty, department, programme, level, gender,assign_lect_id) VALUES ('$first_name', '$last_name','$email', '$mat_no', '$password', '$faculty', '$department', '$programme','$level','$gender', '$assign_lect_id')";
        $run = run_query($query);
        confirm($run);
        if ($run) {
            echo "<script>swal('Success', '".$mat_no." Added','success');</script>";
         }else{
            echo "<script>swal('Error', 'Failed!!','error');</script>";
           }
	}
	function export_data(){    
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
          //echo $output;
         }
	}
 ?>