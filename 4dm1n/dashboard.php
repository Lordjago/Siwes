<?php 
	require'includes/controller.php';
 ?>
 <style type="text/css">
 body{
  background: #eceff1;
 }
   .card-panel{
    height: 150px;
   }
 </style>
 <main style="margin-left: 15px; margin-top: 20px; margin-bottom: 90px;">
  <div class="row">
    <p class="left"><strong>Hello, <em><?php if (admin_loggedin()) {
      echo admin_first_name($_SESSION['admin']); 
    }elseif (staff_loggedin()) {
      echo staff_first_name($_SESSION['staff']);
    }  ?></em></strong></p>
    <p style="margin-bottom: 10px; margin-right: 30px;" class="right">Dashboard/Home</p>	 
  </div>
  <hr>
  <div class="row"><?php if (admin_loggedin()) {?>
    <div class="col s12 m3">
      <div class="card-panel white z-depth-3">
        <img src="../assets/image/admin.png" class="cicle left" style="width: 70px; height: 70px;">
        <span class="grey-text darken-1" style="padding-left: 30px; margin-bottom: 20px;">
          Administrator
        </span><br>
        <span class="black-text darken-1" style="margin-left: 70px;">
          <?php
            echo get_admin();
          ?>
        </span>
      </div>
    </div>
  <div class="col s12 m3">
      <div class="card-panel white z-depth-3">
        <img src="../assets/image/staff.png" class="cicle left" style="width: 70px; height: 70px;">
        <span class="grey-text darken-1" style="padding-left: 40px; margin-bottom: 20px;">
          Lecturers
        </span><br>
        <span class="black-text darken-1" style="margin-left: 70px;">
          <?php
            echo get_staff();
          ?>
        </span>
      </div>
    </div>
    <div class="col s12 m3">
      <div class="card-panel white z-depth-3">
        <img src="../assets/image/students.png" class="cicle left" style="width: 70px; height: 70px;">
        <span class="grey-text darken-1" style="padding-left: 40px; margin-bottom: 20px;">
          Students
        </span><br>
        <span class="black-text darken-1" style="margin-left: 70px;">
          <?php
            echo get_std();
          ?>
        </span>
      </div>
    </div>
    <div class="col s12 m3">
      <div class="card-panel white z-depth-3">
        <img src="../assets/image/total.jpeg" class="cicle left" style="width: 70px; height: 70px;">
        <span class="grey-text darken-1" style="padding-left: 60px; margin-bottom: 20px;">
          Total
        </span><br>
        <span class="black-text darken-1" style="margin-left: 70px;">
          <?php
            echo get_total();
          ?>
        </span>
      </div>
  </div></div>
      <?php 
      include'includes/template/calender.php';
     ?>
  <?php }elseif (staff_loggedin()) {?>
    <div class="col s12 m6">
      <div class="card-panel white z-depth-3">
        <img src="../assets/image/students.png" class="cicle left" style="width: 70px; height: 70px;">
        <span class="grey-text darken-1" style="padding-left: 175px; margin-bottom: 20px;">
          Students
        </span><br>
        <span class="black-text darken-1" style="margin-left: 200px;">
          <?php
            echo get_lect_std($_SESSION['staff']);
          ?>
        </span>
      </div>
    </div>
    <div class="col s12 m6">
      <div class="card-panel white z-depth-3">
        <img src="../assets/image/total.jpeg" class="cicle left" style="width: 70px; height: 70px;">
        <span class="grey-text darken-1" style="padding-left: 160px; margin-bottom: 20px;">
          Report Submitted
        </span><br>
        <span class="black-text darken-1" style="margin-left: 210px;">
          <?php
            echo get_lect_report($_SESSION['staff']);
          ?>
        </span>
      </div>
    </div><br></div>
 <?php include'includes/template/calender.php'; } 
      
   ?>
</main>
<?php 
      include '../includes/template/footer.php';
 ?>