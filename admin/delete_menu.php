<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM wines WHERE w_id = '".$_GET['menu_del']."'");
header("location:all_wines.php");  

?>