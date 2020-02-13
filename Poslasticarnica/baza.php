<?php
if(!defined('PRISTUP')) {
    header("Location: error/fourOfour.php");
    die();
 }
    $source = 'mysql:host=localhost;dbname=posi;charset=utf8mb4';
    $user = 'root';
    $pass = '';
    $db = new PDO($source,$user,$pass);
    if(!$db){
        die("Connection failed!");
    }
  
?>