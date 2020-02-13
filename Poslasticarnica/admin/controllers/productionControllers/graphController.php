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
        $input = file_get_contents("php://input");
        $input = json_decode($input,true);
        $startDate = filter_var($input['startDate'],FILTER_SANITIZE_STRING);
        $endDate   = filter_var($input['endDate'],FILTER_SANITIZE_STRING);
        $tip       = filter_var($input['tip'],    FILTER_SANITIZE_NUMBER_INT);
        if($tip == 0){
            $objArray=(getProducedAmount($startDate, $endDate, $db));
            if(!empty($objArray)){
                foreach($objArray as $obj){
                    $dateArray  [] = $obj->ime;
                    $valueArray [] = $obj->Kolicina;
                }
                header('Content-type: text/html; charset=utf-8');
                echo json_encode(array('datumi'=>$dateArray,'vrednosti'=>$valueArray));
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