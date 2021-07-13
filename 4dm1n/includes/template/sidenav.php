	<?php 
      session_start();
  if (!$_SESSION['admin']) {
    if (!$_SESSION['staff']) {
      header('location:../index.php');
    }
    
  }
   ?>
  <style type="text/css">
		 header, main, footer {
      padding-left: 300px;
    }

    @media only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
      }
    }
        @media only screen and (max-width : 360px) {
      .hideit {
       display: none;
       max-height: 0;
       overflow: hidden;
      }
    }
    .hideit:hover{
    	cursor: pointer;
    }
            @media only screen and (max-width : 688px) {
      #info {
       display: block;
      }
    }
    body{
      background-color: #fff;
      color:#000;
      font-size: inherit;
    }

	a{
		color: #fff;
		text-align: left;

	}
	.collapsible-body{
		border-bottom: 1px solid #ddd;
	}  
	.span:hover{
		font-size: 13px;
	}
	li{
		text-align: -webkit-match-parent;
		position: relative;
	}
	</style>
 <body> 
  <script type="text/javascript">
          $(document).ready(function(){
             $('.sidenav').sidenav();
             $('.collapsible').collapsible();
          });
      function logout(){
            swal({
                    title: "Are you sure you want to logout?",
                    text: "Once logout, you will not be able to recover this session!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      window.location.assign('../logout.php');
                    } else {
                      return false;
                    }
                  });
      }
  //     function hideit(){
  //     	$('.hideit').click(function(){
  //     		$('.sidenav').hide();
  //     		$(this).html('<i class="material-icons"  style="color:#343957; margin-right:1000px;">arrow_forward</i>').className('showit');
  //     	});
  // //     	$(".showit").click(function(){
  // //   	$(".sidenav").show();
		// // });
  //     }
  </script>
  <div class="row">
  	<div class="col s2">
		<ul id="slide-out" class="sidenav sidenav-fixed white darken-4">
		   <li><div class="user-view center" style="background-color: #343957; height: 100%;">
		 	<div class="row">
            <div class="col s3"></div><?php if (admin_loggedin()){?>
            <div class="col s3" style="margin-top: 10px; color: #dddddd; font-size: 25px; text-align: center;"><strong>Admin</strong></div>
          <?php }else if (staff_loggedin()) {?>
          <div class="col s3" style="margin-top: 10px; color: #dddddd; font-size: 25px; text-align: center;"><strong>Staff</strong></div>
        <?php } ?>
            <div class="col s3"></div>
        </div>
        <div class="row">
        	<ul class="collapsible" style="color: #ffffff;">
        		<p style="margin-top: 30px; color: #dddddd; text-align: left;">Main</p>
        		<li>
			      <a href="dashboard.php" class="collapsible-header" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">donut_large</i>Dashboard</a>
			    </li>
			    <li>
			      <hr>
			    </li>
			    <p style="margin-top: 40px; color: #dddddd; text-align: left;">Actions</p>
          <?php if (admin_loggedin()) {?>
			    <li>
			      <a class="collapsible-header arrow_drop" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">pageview</i>Views<i class="material-icons right"  style="color: #cfd8dc;">arrow_drop_down</i></a>
			      <div class="collapsible-body" style="background-color:#343957;">
			      	<span class="span"><a href="views.php?r_val=<?php echo $admin = base64_encode('Admin');  ?>">Administrator</a></span><br>
              <span class="span"><a href="views.php?r_val=<?php echo $staff = base64_encode('Staff');  ?>">Lecturers</a></span><br>
              <span class="span"><a href="views.php?r_val=<?php echo $student = base64_encode('Student');  ?>">Students</a></span><br>
			      </div>
			    </li>
			    <li>
			      <a href="emails.php" class="collapsible-header" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">email</i>Emails</a>
			    </li>
			    <li>
			      <a href="profile.php" class="collapsible-header" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">account_circle</i>Profile</a>
			    </li>
			    <li>
			      <a class="collapsible-header" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">add</i>Append<i class="material-icons right"  style="color: #cfd8dc;">arrow_drop_down</i></a>
			      <div class="collapsible-body" style="background-color:#343957;">
			      	<span class="span"><a href="add_new.php?r_val=<?php echo $admin = base64_encode('Admin');  ?>">Administrator</a></span><br>
			      	<span class="span"><a href="add_new.php?r_val=<?php echo $staff = base64_encode('Staff');  ?>">Lecturers</a></span><br>
			      	<span class="span"><a href="add_new.php?r_val=<?php echo $student = base64_encode('Student');  ?>">Students</a></span><br>
			      </div>
			    </li>
          <li>
           <a href="account.php" class="collapsible-header" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">schedule</i>Account Reset</a>
          </li>
          <p style="margin-top: 10px; color: #dddddd; text-align: left;">Exit</p>
			    <li>
			      <div class="collapsible-header" onclick=(logout()) style="margin-bottom: 70px;"><i class="material-icons">close</i>Logout</div>
			    </li>
          <?php }else if (staff_loggedin()) {?>
          <li>
            <a href="views.php?r_val=<?php echo $student = base64_encode('Student'); ?>" class="collapsible-header" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">group</i>Students</a>
          </li>
          <li>
            <a href="reportsheet.php?id=<?php echo $_SESSION['staff']?>" class="collapsible-header" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">report</i>Reports</a>
          </li>
          <li>
            <a href="profile.php" class="collapsible-header" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">account_circle</i>Profile</a>
          </li>
            <li>
           <a href="account.php" class="collapsible-header" style="margin-bottom: 10px; color: #fff;"><i class="material-icons"  style="color: #fff;">schedule</i>Account Reset</a>
          </li>
          <p style="margin-top: 10px; color: #dddddd; text-align: left;">Exit</p>
          <li>
            <div class="collapsible-header" onclick=(logout()) style="margin-bottom: 70px;"><i class="material-icons">close</i>Logout</div>
          </li>
        <?php } ?>
			  </ul>
      	</div>
      </div>
		    </ul>
		</div>
    <script type="text/javascript">
      $('arrow_drop').on('click', function(){
         $('.right').hide();
         $(this).html('<i class="material-icons right"  style="color: #cfd8dc;">arrow_drop_down</i>');
      
      });
    </script>

 