<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../error/fourOfour.php");
    die();
    
}
define('PRISTUP', TRUE);
require_once '../baza.php';
header('Content-type: text/html; charset=utf-8');

if(isset($_SESSION['magacin'])){
    if($_SESSION['magacin']==0){

		$input = file_get_contents("php://input");
		$input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    	if($input == 1){
 		$prep = $db->prepare("SELECT posi.magacin.ime, posi.magacin.tip, posi.magacin.kolicina FROM posi.magacin ORDER BY(posi.magacin.ime)ASC;");
		$prep->execute([]);
		$all = $prep->fetchAll(PDO::FETCH_OBJ); 
 		foreach($all as $show){
			
    		$id=1;
        	echo"
        		<div id = 'tabela".$id."'>
            		<span >".$show->ime."</span>
            		<span>".$show->tip."</span>
            		<span>".$show->kolicina." Kg/komad</span>
        		</div>";
        	$id++;

 		}
 		}

 }
 else{
    echo" <script type='text/javascript'>alert('The page that you are trying to access is forbidden, log in again!');window.location.replace('../login/login.html');</script>" ;   
}
 }
else{
    echo" <script type='text/javascript'>window.location.replace('../login/login.html');</script>" ;   
}
?>