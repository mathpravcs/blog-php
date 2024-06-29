<?php 

require 'config/constants.php';
$connection = new mysqli(HOST,USER,PASS,DB);

if(mysqli_error($connection)){
    die(mysqli_error($connection));
}
?>