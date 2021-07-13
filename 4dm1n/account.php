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
    <p style="margin-bottom: 10px; margin-right: 30px;" class="right">Account Reset</p>	 
  </div>
  <hr>
    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  style="height:300px; margin-top: 70px;">
          <div class="input-field col s12 ">
            <i class="material-icons prefix">email</i>
            <input id="icon_prefix" type="text" class="validate" name="email" autofocus>
            <label for="icon_prefix">Email</label><br><br>
          </div>
          <div class="col s12 center">   
            <button id="add" class="btn waves-effect waves-light center white-text" style="background:#343957; border-radius: 3px; margin-bottom: 30px;">Submit</button>
          </div>   
          <div class="col s1"></div>
                  </form>
</main>
<?php 
      include '../includes/template/footer.php';
 ?>