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
    if($input === 'ok'){
        $prepGetKorpa = $db->prepare("SELECT posi.korpa.proizvod_id AS id, SUM(posi.korpa.kolicina) AS kolicina 
                          FROM posi.korpa GROUP BY posi.korpa.proizvod_id;");
        $resGetKorpa  = $prepGetKorpa->execute();
        $korpaArray = $prepGetKorpa->fetchAll(PDO::FETCH_OBJ);
        $user = $_SESSION['radnja1'];//broj prodajne jedinice
        $prepUmanjiStanjeProizvoda = $db->prepare( "UPDATE posi.proizvodkolicina SET
                                       posi.proizvodkolicina.kolicina = (posi.proizvodkolicina.kolicina - ?)
                                       WHERE posi.proizvodkolicina.proizvod_id = ?;");//$korpaArray[$i]->kolicina, $korpaArray[$i]->id
        $prepCena = $db->prepare("SELECT posi.proizvodi.cena FROM posi.proizvodi WHERE posi.proizvodi.proizvod_id = ?;");//$korpaArray[$i]->id
        $ukupnoArray = array();

        for($i = 0; $i < COUNT($korpaArray); $i++){
            $resUmanjiStanjeProizvoda = $prepUmanjiStanjeProizvoda->execute([$korpaArray[$i]->kolicina, $korpaArray[$i]->id]);
            $resCena = $prepCena->execute([$korpaArray[$i]->id]);
            $cena = $prepCena -> fetch(PDO::FETCH_OBJ);
            array_push($ukupnoArray,$cena->cena*$korpaArray[$i]->kolicina);
        }
        
        $prepEvProdaju = $db->prepare("INSERT INTO posi.prodaja (posi.prodaja.proizvod_id, posi.prodaja.kolicina, posi.prodaja.ukupno, posi.prodaja.user_id) 
                                       VALUES(?,?,?,?);");//$korpaArray[$i]->id, $korpaArray[$i]->kolicina, $ukupnoArray[$i], $user;
        for($i = 0; $i < COUNT($ukupnoArray); $i++){
            $resEvProdaju = $prepEvProdaju->execute([$korpaArray[$i]->id, $korpaArray[$i]->kolicina, $ukupnoArray[$i], $user]);
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