<style type="text/css">
 .page-footer {
    display: flex;
    flex-direction: column;
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
  }

  main {
    flex: 1 0 auto;
  }
</style>
    <footer class="page-footer" style="background-color: #343957; color: #fff; font-size: 11px;">
          <div class="footer-copyright">
            <div class="container center">
            Terms of Service | Privacy Policy | &copy; Jago_Offical 2018.<br>
            Powered by: Jago_Offical
            </div>
          </div>
    </footer>
    <?php 
      if (isset($db)) {
        mysqli_close($db);
      }
     ?>