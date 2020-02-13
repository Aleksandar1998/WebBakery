<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: /error/fourOfour.php");
    die();
    
}
$input = file_get_contents("php://input");
$input = filter_var($input, FILTER_SANITIZE_STRING);

if(strcmp($input,'magacin') == 0){
    unset($_SESSION['magacin']);
                        }
if(strcmp($input,'proizvodnja') == 0){
    unset($_SESSION['proizvodnja']);
                            }

if(strcmp($input,'radnja1') == 0){
    unset($_SESSION['radnja1']);
}


if(strcmp($input,'admin') == 0){
    unset($_SESSION['admin']);
}





?>