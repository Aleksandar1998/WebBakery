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
    $input = filter_var($input, FILTER_SANITIZE_STRING);
    if($input === 'dole'){
        $prep = $db->prepare("SELECT SUM(posi.korpa.cena*posi.korpa.kolicina) AS cena FROM posi.korpa;");
        $res = $prep->execute();
        $cena = $prep->fetchAll(PDO::FETCH_OBJ);
        echo $cena[0]->cena;
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