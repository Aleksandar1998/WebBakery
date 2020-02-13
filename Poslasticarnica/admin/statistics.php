<?php 
session_start();

if(isset($_SESSION['admin'])){
    if($_SESSION['admin']==-1){



?>
<!DOCTYPE html>
<html>
<head>
<title>Statistics</title>
<link rel="stylesheet" type="text/css" href="statistics.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">


</head>
<body>
<div id="main">
	 <div id='statistics' data-page="views/productionView/production.php" onClick="klik(this.id)">Proizvodnja</div>
	 <div id = 'settings' data-page="views/salesView/sales.php" onclick="klik(this.id)">Prodaja</div>
   
	
	<div id = 'logout' onClick="logout()">Odjava</div>
</div>
</div>

<script src= "admin.js"></script>
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