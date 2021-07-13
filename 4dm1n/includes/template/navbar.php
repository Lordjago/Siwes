<main>
    <nav>
    <div class="nav-wrapper white">
     <a href='#' data-target='slide-out' class='sidenav-trigger white-text'><i class='material-icons' style="padding-right: 320px; color: #343957;">menu</i></a>
      <a onclick=(hideit()) class="brand-logo black-text hideit" style="margin-left: 10px;"><i class='material-icons' style=" color: #343957;">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
         <li><i class='material-icons black-text' id="info" style="margin-right: 30px;">notifications</i></a></li>
          <li><i class='material-icons black-text' id="info" style="margin-right: 30px;">mail</i></a></li>
                  <!-- Dropdown Trigger -->
          <li><a class='dropdown-trigger black-text' href='#' data-target='dropdown1'><?php if (admin_loggedin()) {
            echo strtoupper($_SESSION['admin']);
          } elseif (staff_loggedin()) {
           echo strtoupper($_SESSION['staff']);
          } ?><i class='material-icons right'>arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>
</main>