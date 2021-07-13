<?php
  require'includes/controller.php';
  session_start();
  if (!$_SESSION) {
    header('location:admin_login.php');
  }
  if (isset($_GET['id']) && isset($_GET['action'])) {
      $mat_no = $_GET['id'];
    if($_GET['action'] === 'edit'){
    $query = "SELECT * FROM applicants WHERE mat_no = '$mat_no'";
    $run = run_query($query);
    confirm($run);
    while ($row = mysqli_fetch_array($run)) {
         $first_name = strtoupper($row['first_name']);
         $last_name = $row['last_name'];
         $mat_no = strtoupper($row['mat_no']);
         $email = $row['email'];
         $password = $row['password'];
         $faculty = $row['faculty'];
         $department = $row['department'];
         $programme = $row['programme'];
         $level = $row['level'];
         $gender = $row['gender'];
         }
}
  }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    std_update($_POST);
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
.modal{
  border-radius: 6px;
  border-style: none;
  /*background-color: rgba(255,255,255,0.7);*/
  color: #3f51b5;
}
 </style>
 <body>
 <main style="margin-left: 15px; margin-top: 20px; margin-bottom: 120px;">
  <div class="row">
    <p class="left"><strong>Hello, <em><?php echo admin_first_name($_SESSION['admin']); ?></em></strong></p>
    <p style="margin-bottom: 10px; margin-right: 30px;" class="right">Update</p>   
  </div>
  <hr>
  <div class="row">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
          <div class="input-field col s6">
            <input type="text" class="validate" value="<?php echo $first_name;?>" autofocus>
            <label name="first_name">First Name</label><br><br>
        </div>
          <div class="input-field col s6">
          <input type="text" class="validate" value="<?php echo $last_name;?>">
          <label name="last_name">Last Name</label><br><br>
        </div>
        <div class="input-field col s6">
          <input type="text" class="validate" value="<?php echo $mat_no;?>" disabled>
          <label name="mat_no">Matric Number</label><br><br>
        </div>
        <div class="input-field col s6">
          <input type="text" class="validate" value="<?php echo $email;?>">
          <label name="email">Email</label><br><br>
        </div>
        <div class="input-field col s6">
          <input type="text" class="validate" value="<?php echo $password;?>">
          <label name="password">Password</label>
        </div>
        <div class="input-field col s6">
         <select name="faculty">
          <?php
            echo '<option value="'.$faculty.'" disabled>'.$faculty.'</option>';
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
            <?php
            echo '<option value="'.$department.'" disabled>'.$department.'</option>';
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
            <?php
            echo '<option value="'.$programme.'" disabled>'.$programme.'</option>';
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
          <?php echo '<option value="'.$level.'" disabled>'.$level.'</option>';
            for ($i=300; $i <=400 ; $i=$i+100) { 
              echo "<option>".$i."</option>";
            }
          ?>
        </select>
      <label id="label">Level</label><br>
      </div>
        <div class="input-field col s6">
         <select name="gender">
          <?php echo '<option value="'.$gender.'" disabled>'.$gender.'</option>'; ?>
          <option>Male</option>
          <option>Female</option>
         </select>
         <label>Gender</label>
        </div>
        <div class="col s12 center">   
          <button class="btn waves-effect waves-light center white-text" style="background:#033560; border-radius: 3px; margin-bottom: 30px;" name="submit" onclick="click()">Submit</button>
        </div>   
        <div class="col s1"></div>
      </form>
      </div> 
           </div>
         </div>
   <script type="text/javascript">
    $(document).ready(function(){
    $('select').formSelect();
  });
  </script>
        </div></main>
<?php 
      include '../includes/template/footer.php';
 ?>
  </body>
  </html>