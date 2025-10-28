<?php

session_start();
session_destroy();  //clear existing session for login page
header("Location: index.php");  //go back to homepage if already logged in
exit();

?>