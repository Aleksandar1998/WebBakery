<?php 
session_start();

if(isset($_SESSION['magacin'])){
    if($_SESSION['magacin']==0){



?>
<!DOCTYPE html>
<head>
<title>Magacin</title>
<link rel="stylesheet" type="text/css" href="magacin.css">
</head>
<body>
	<div id="main">
	<div></div>
	<div id="wrapper">
		<div id="gore">
			<a href="prijem.php"><button type="button" id="prijem">Prijem</button></a>

		</div>
		
		<div id="dole">
			<button type="button" id="logout" OnClick="logout('magacin')">Odjavi se</button>
		</div>
	</div>
	
	<div></div>
	</div>
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