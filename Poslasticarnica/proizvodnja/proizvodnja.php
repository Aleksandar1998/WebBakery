<?php
session_start();

header('Content-type: text/html; charset=utf-8');


if(isset($_SESSION['proizvodnja'])){
    if($_SESSION['proizvodnja']==1){
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <link rel="stylesheet" type="text/css" href="proizvodnja.css">
	<title>Proizvodnja</title>
</head>
<body  onLoad="generate()">
	<div id='main'>
		
                 
        
	</div>
<div id='btn'><button type="button" id="logout" onClick="logout('proizvodnja')">Odjavi se</button></div>
<script src="proizvodnja.js"></script>
<script src="..\logout.js"></script>
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