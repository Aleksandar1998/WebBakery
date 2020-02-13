<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../error/fourOfour.php");
    die();
    
}
header('Content-type: text/html; charset=utf-8');
define('PRISTUP', TRUE);
require_once "../functions.php";
if(isset($_SESSION['magacin'])){
    if($_SESSION['magacin']==0){

	$input = file_get_contents("php://input");
	$input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);

	echo"
		<div id='celina'>
		<div class='content'>
	    <input type='text' placeholder='Ime Proizvoda' id='ime".$input."' onFocusOut='checkName(this.id)'/><br/>
	    
	    <select id='dd".$input."'>
	    <option selected disabled>Odaberi tip proizvoda</option>";
	    selectTip($input);
	    echo"
	   	</select>
	   	<br/>
        <input type='number'placeholder='Količina' min='0' step='.01' onFocusOut='checkAmount(this.id)' id='kolicina".$input."'><br/>
        </div>
        <button type='button' onClick='addForm()'>Dodaj</button>
        <button type='button' id='button".$input."' onClick='removeForm(this.id)'>Ukloni</button>
        </div>
        ";
   

}
else{
    echo" <script type='text/javascript'>alert('The page that you are trying to access is forbidden, log in again!');window.location.replace('../login/login.html');</script>" ;   
}
}
else{
    echo" <script type='text/javascript'>window.location.replace('../login/login.html');</script>" ;   
}

?>