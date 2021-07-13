<?php
session_start();
unset($_SESSION['mat_no']);
session_destroy();
header('location:index.php');
?>
