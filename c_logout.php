<?php
session_start();
session_destroy();
header("location:c_login.php");

?>