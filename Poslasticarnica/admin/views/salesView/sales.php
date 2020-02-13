<?php 
session_start();

if(isset($_SESSION['admin'])){
    if($_SESSION['admin']==-1){



?>
<!DOCTYPE html>
<html>
<head>
<title>Sales</title>
<link rel="stylesheet" type="text/css" href="sales.css">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body onLoad='setDates()'>
<div id="main">
	<div id="gore">
	<canvas id='graph'></canvas>
	</div>
	<div id="dole">
		<div id='left'>
			<div id='start' onFocusIn="deleteMax()"><span>From</span><br/></div>
			<div id='end'></div>
		</div>
		<div id='center'>
			<select id='tip'>
	   	    	<option selected disabled value='-1'>Choose data to be shown</option>
	   	    	<option id='0' value='0'>Earnings</option>
	    		<option id='1' value='1'>Sold amount</option>
	   		</select>
	   		<button type="button" onClick='generateGraph()'>Confirm</button>
		</div>
		<div id='right'>
			<button type='button' onClick='getXML()'>Export data</button>
			<button type='button' onClick="location.href='../../statistics.php';">Back</button>
		</div>
	</div>

</div>
<script src='sales.js'></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
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