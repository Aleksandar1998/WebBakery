<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../error/fourOfour.php");
    die();
    
}
define('PRISTUP', TRUE);
require_once '../baza.php';
if(isset($_SESSION['radnja1'])){
    if($_SESSION['radnja1']==2){
    
    $input = file_get_contents("php://input");
    $input = filter_var($input,FILTER_SANITIZE_STRING);
    $prepId= $db->prepare("SELECT posi.proizvodi.proizvod_id AS 'id' FROM posi.proizvodi WHERE posi.proizvodi.ime = ?;");//$input
    $resId = $prepId->execute([$input]);
    $id = $prepId->fetchAll(PDO::FETCH_OBJ);
    $prepareRm= $db->prepare("DELETE FROM posi.korpa WHERE posi.korpa.proizvod_id = ?;");//$id
    $resRM = $prepareRm->execute([$id[0]->id]);
    //count all rows
    $prepCount= $db->prepare("SELECT COUNT(DISTINCT(posi.korpa.proizvod_id)) AS 'count' FROM posi.korpa;");
    $resCount = $prepCount->execute();
    $count = $prepCount->fetchAll(PDO::FETCH_OBJ);
    $count = $count[0]->count;
    echo $count;
}
else{
    echo" <script type='text/javascript'>alert('The page that you are trying to access is forbidden, log in again!');window.location.replace('../login/login.html');</script>" ;   
}
    }
else{
    echo" <script type='text/javascript'>window.location.replace('../login/login.html');</script>" ;
}

    

?>