<?php

session_start();
define('PRISTUP', TRUE);
require "../functions.php";
header('Content-type: text/html; charset=utf-8');


if(isset($_SESSION['magacin'])){
    if($_SESSION['magacin']==0){
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <link rel="stylesheet" type="text/css" href="prijem.css">
	<title>Prijem</title>
</head>
<body onload="generateMagacin()">
<div id='mainwrap'>
<div id="wrap1">
    <div id="main">
    <div id="celina">
    
    <div class="content">

	    <input placeholder="Ime Proizvoda" type="text" id="ime0" onFocusOut='checkName(this.id)'>
        
        <br/>
	    
	    <select id="dd0">
	    <option selected disabled >Odaberi tip proizvoda</option>
	    <?php selectTip(0);?>
	   	</select>
	   	<br/>
        <input placeholder="Količina (kg/komad)" type="number"  max = "99999" min="0" step=".01" 
        id="kolicina0"  onFocusOut='checkAmount(this.id)'><br/>
        
    </div>
    
    <button type='button'  onClick='addForm()'>Dodaj</button>
    

    </div>

    </div>
    <div id="posalji">
        <button type="button" id="bposalji" onClick="sendForm()">Pošalji</button>
    </div>
    <div id="nazad">
        <a href="magacin.php"><button type="button" id="bnazad">Nazad</button></a>
    </div>
</div>

<div id='wrap2'>
    <div id ='title'><h1>Spisak sirovina u bazi podataka</h1></div>
    <div id ="zaSlanje">
    <div id = "field">

        
        
    </div>

    </div>
</div>
</div>
<script src="addForm.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>
<?php }
else{
    echo" <script type='text/javascript'>alert('The page that you are trying to access is forbidden, log in again!');window.location.replace('../login/login.html');</script>" ;   
}
}
else{
   echo"<script type='text/javascript'>window.location.replace('../login/login.html');</script>";
}

?>