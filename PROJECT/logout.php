<?php
// filepath: c:\xampp\htdocs\PROJECT\logout.php
session_start();
session_unset();
session_destroy();
header("Location: signin.php");
exit();