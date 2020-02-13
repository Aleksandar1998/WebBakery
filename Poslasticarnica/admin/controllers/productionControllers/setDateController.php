<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../../../error/fourOfour.php");
    die();
    
}
header('Content-type: text/html; charset=utf-8');
define('PRISTUP', TRUE);
require_once '../../../baza.php';
require_once '../../models/productionStatistics/productionModel.php';
if(isset($_SESSION['admin'])){
    if($_SESSION['admin']==-1){
        $dateTimeMin = (getMinDate($db))->datum;
        $dateMin = (explode(" ",$dateTimeMin))[0];
        
        $dateTimeMax = (getMaxDate($db))->datum;
        $dateMax = (explode(" ",$dateTimeMax))[0];

        echo $dateMin.','.$dateMax;
        




    }
else{
    echo" <script type='text/javascript'>alert('The page that you are trying to access is forbidden, log in again!');window.location.replace('../login/login.html');</script>" ;   
}
 }
else{
    echo" <script type='text/javascript'>window.location.replace('../login/login.html');</script>" ;   
}
?>