<?php 
ob_start();

session_start();

defined("DB") ? null : define("DB", "blog");

defined("DU") ? null : define("DU", "root");

defined("DP") ? null : define("DP", "");

defined("DH") ? null : define("DH", "localhost");


$connection = mysqli_connect(DH, DU, DP, DB);


if ($connection == mysqli_connect_error()){
	die("MySql connection error : ". mysqli_connect_error());
}

require "functions.php";
?>