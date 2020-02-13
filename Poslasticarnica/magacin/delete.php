<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../error/fourOfour.php");
    die();
    
}
header('Content-type: text/html; charset=utf-8');
define('PRISTUP', TRUE);
require_once('../baza.php');

if(isset($_SESSION['magacin'])){
    if($_SESSION['magacin']==0){
		$input = file_get_contents("php://input");
		$input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
		$prep = $db->prepare("DELETE  FROM posi.prijempomocna WHERE posi.prijempomocna.prijemPomocna_id = ?;");//input
		$prep->execute([]);
}
else{
    echo" <script type='text/javascript'>alert('The page that you are trying to access is forbidden, log in again!');window.location.replace('../login/login.html');</script>" ;   
}
}
else{
    echo" <script type='text/javascript'>window.location.replace('../login/login.html');</script>" ;   
}
?>