<?php 
session_start();

if(isset($_SESSION['radnja1'])){
    if($_SESSION['radnja1']==2){



?>
<!DOCTYPE html>
<html>
<head>
<title>Prodaja</title>
<link rel="stylesheet" type="text/css" href="prodaja.css">

</head>
<body  onLoad="generateLeft(),generateCenter('sve'),cleanKorpa()">
<div id="main">
	
		<div id='left' >
			<div id='kat'>
			<button type="button" id="sve" OnClick="generateCenter(this.id)" class='kategorije'>Sve</button>
			</div>
			<button type='button' id='logout' OnClick="logout('radnja1')" class='kategorije'>Odjavi se</button>
		</div>
	
		<div id='center'>

		</div>
	<div id ="right">
		<div id ="zaSlanje">

    	<div id = "field">
    		<div id = 'tabela'>
            		<span >Ime</span>
            		<span> Količina</span>
            		<span> Cena</span>
            		<button type='button' id='btn' style='visibility:hidden;'>Obriši</button>
        	</div>


    	</div>
		</div>
		<div id='dole'>
			<span id = 'ukupno'></span><span id = 'cena' value='1'></span>
			<div id = 'racunaj'>
			
			</div>
		</div>
	</div>
</div>
<script src= "prodaja.js"></script>
<script src="../logout.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>

 <?php }

else{
    echo" <script type='text/javascript'>alert('The page that you are trying to access is forbidden, log in again!');window.location.replace('../login/login.html');</script>" ;   
}
}


else{
    echo" <script type='text/javascript'>window.location.replace('../login/login.html');</script>" ;   
}

?>