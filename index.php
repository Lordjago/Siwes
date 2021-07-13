<?php 
  require 'includes/template/banner.php';
  require 'libraries/connection/config.php';
  include 'libraries/functions/functions.php';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (strlen($_POST['mat_no']) === 4) {
      auth_admin($_POST);
    }else if (strlen($_POST['mat_no']) === 5) {
      auth_staff($_POST);
    }else{
      auth_std($_POST);
    }
    
    }         
 ?>
 <title>Siwes Report System</title>
<div id="multiple" class="col s12">
          <div class="row">
            <div class="input-field col s12 l2"></div>
            <form class="col s12 card-panel l8" method="POST" enctype="multipart/form-data">
              <input type="hidden" hidden name="title">
              <div class="center"> 
                <h5>Login</h5>
                <p></p>
              </div>
              <div class="row">
                  <div class="col s12 l2"></div>
                  <div class="input-field col s12 l8">
                      <i class="material-icons prefix">account_circle</i>
                      <input id="mat_no" required name="mat_no" type="text" class="validate" value="<?php echo $_COOKIE['mat_no'];?>">
                      <label for="mat_no">Matric Number/Staff ID</label>
                  </div>
                  <div class="col s12 l2"></div>
                </div>
                <div class="row">
                  <div class="col s12 l2"></div>
                  <div class="input-field col s12 l8">
                      <i class="material-icons prefix">lock_outline</i>
                      <input id="password" required name="password" type="password" class="validate" value="<?php echo $_COOKIE['password'];?>">
                      <label for="password">Password</label>
                  </div>
                  <div class="col s12 l2"></div>
                </div>
                <div class="row">
                  <div class="col s12 l4"></div>
                  <div class="input-field col s12 l4 center">
                    <button class="btn" style="background: #670d10;">Login</button>
                  </div>
                  <div class="col s12 l4"></div>

                </div>
            </form>
            <div class="input-field col s12 l2"></div>
        </div>

                <div class="row">
                  <div class="col s4"></div>
                  <!-- Modal Trigger -->
                  <div class="col s12 m4" style="margin-left: 90px;">Click <a class="modal-trigger center btn" href="#modal1" style="background:#670d10;">Here</a> to reset password</div>
                  <div class="col s4"></div>
                </div>
                  <!-- Modal Structure -->
                  <div id="modal1" class="modal">
                    <div class="modal-content">
                      <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  style="height:300px;">
                          <h5 class="left black-text" style="margin-top: 30px; font-family: sans-serif; font-size: 25px; margin-left: 40px; margin-bottom: 50px;">Reset Password</h5>   
                            <div class="input-field col s12 ">
                              <i class="material-icons prefix">email</i>
                              <input id="icon_prefix" type="text" class="validate" name="email" autofocus>
                              <label for="icon_prefix">Email</label><br><br>
                            </div>
                          <div class="col s12 center">   
                          <button id="add" class="btn waves-effect waves-light center white-text" style="background:#033560; border-radius: 3px; margin-bottom: 30px;">Submit</button>
                          <p>Return to<a href="index.php"> Home</a></p>
                        </div>   
                    <div class="col s1"></div>
                  </form>
                    </div>
                  </div>
      </div>
      <script type="text/javascript">
         $(document).ready(function(){
          $('.modal').modal();
        });
      </script>
    </body>
    </html>
