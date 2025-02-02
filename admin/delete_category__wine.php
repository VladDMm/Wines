<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

mysqli_query($db,"DELETE FROM wine_category WHERE wcat_id = '".$_GET['cat_del']."'");
header("location:add_category_wine.php");  

?>