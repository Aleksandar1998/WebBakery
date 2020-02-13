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
    $input = json_decode($input,true);
    $id = filter_var($input['id'],FILTER_SANITIZE_NUMBER_INT);
    $kolicina = filter_var($input['kolicina'],FILTER_SANITIZE_NUMBER_INT);
    $cena = filter_var($input['cena'], FILTER_SANITIZE_STRING);
    $prep = $db->prepare("INSERT INTO posi.korpa (posi.korpa.proizvod_id, posi.korpa.kolicina, posi.korpa.cena) VALUES(?,?,?);");//$id,$kolicina,$cena
    $res = $prep->execute([$id, $kolicina, $cena]);
    $selectPrep = $db->prepare("SELECT posi.proizvodi.ime, SUM(posi.korpa.kolicina) AS kolicina, posi.proizvodi.cena FROM posi.proizvodi
    LEFT JOIN posi.korpa ON posi.proizvodi.proizvod_id = posi.korpa.proizvod_id
    WHERE posi.proizvodi.proizvod_id = posi.korpa.proizvod_id
                            GROUP BY(posi.korpa.proizvod_id);");
    $selectRes = $selectPrep->execute();
    $cart = $selectPrep->fetchAll(PDO::FETCH_OBJ);
    for($i  = 0 ; $i <COUNT($cart); $i++){
        echo"
        <div id = '".$cart[$i]->ime."'>
              <span >".$cart[$i]->ime."</span>
              <span> x".$cart[$i]->kolicina."</span>
              <span>".$cart[$i]->cena."</span>
              <button type='button' id='".$cart[$i]->ime."'  onClick = 'obrisi(this.id)'>Obriši</button>
        </div>";
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