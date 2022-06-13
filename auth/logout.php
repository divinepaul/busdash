<?php
include("../config/all_config.php"); 
include("../lib/all_lib.php"); 
session_destroy();
redirect("/auth/login.php");
?>
