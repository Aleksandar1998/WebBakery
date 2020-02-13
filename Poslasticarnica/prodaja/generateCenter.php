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
    //odabir proizvoda zajednicko za selekciju i bez nje
    $prep1 = $db->prepare("SELECT posi.proizvodkolicina.proizvod_id AS 'id', posi.proizvodkolicina.kolicina
     FROM posi.proizvodkolicina WHERE posi.proizvodkolicina.kolicina > ?;"); //0
    $res1 = $prep1->execute([0]);
    $arrId = $prep1->fetchAll(PDO::FETCH_OBJ);

    if($input == 'sve'){
        $arrProizvodi = array();
        $selectProizvod= $db->prepare("SELECT posi.proizvodi.ime, posi.proizvodi.cena FROM 
        posi.proizvodi WHERE posi.proizvodi.is_aktivan = ? AND posi.proizvodi.proizvod_id = ?;");//1 i $arrId[$i]->id
        for($i=0; $i<COUNT($arrId); $i++){
            $proizvod = $selectProizvod->execute([1,$arrId[$i]->id]);
            $proizvod = $selectProizvod->fetch(PDO::FETCH_OBJ);
            
            array_push($arrProizvodi,$proizvod);
        }
        for($i=0; $i<COUNT($arrId); $i++){
            echo "  
                    <div id='proizvod".$arrId[$i]->id."' class = 'element'>
                        <span id='ime".$arrId[$i]->id."'>".$arrProizvodi[$i]->ime."</span>
                        <input  type='number' min='1' max=".$arrId[$i]->kolicina." placeholder = 'Unesite količinu maks=".$arrId[$i]->kolicina." ' id='kolicina".$arrId[$i]->id."'>
                        <span id='cena".$arrId[$i]->id."'>".$arrProizvodi[$i]->cena."</cena></span>
                        <button id='".$arrId[$i]->id."' type='button' onClick='addToCart(this.id)'>Potvrdi</button>
                    </div>";
        }
    }
    //Ako je odabrana neka od opcija za sortiranje
    else{
        $arrProizvodi = array();
        $selectProizvod = $db->prepare("SELECT posi.proizvodi.ime, posi.proizvodi.cena, posi.proizvodi.tip  FROM posi.proizvodi 
        WHERE posi.proizvodi.is_aktivan = ? AND posi.proizvodi.proizvod_id = ? AND posi.proizvodi.tip = ?;");// 1 i $arrId[$i]->id i $input
        for($i=0; $i<COUNT($arrId); $i++){
            $proizvod = $selectProizvod->execute([1,$arrId[$i]->id,$input]);
            $proizvod = $selectProizvod->fetch(PDO::FETCH_OBJ);
            array_push($arrProizvodi,$proizvod);
        }
        for($i = 0; $i<COUNT($arrProizvodi); $i++){
            if($arrProizvodi[$i]==false){
                continue;
            }
            if($arrProizvodi[$i]->tip ==$input){

                echo "  
                    <div id='proizvod".$arrId[$i]->id."' class = 'element'>
                        <span id='ime".$arrId[$i]->id."'>".$arrProizvodi[$i]->ime."</span>
                        <input  type='number' min='1' max=".$arrId[$i]->kolicina." placeholder = 'Unesite količinu maks=".$arrId[$i]->kolicina." ' id='kolicina".$arrId[$i]->id."'>
                        <span id='cena".$arrId[$i]->id."'>".$arrProizvodi[$i]->cena."</cena></span>
                        <button id='".$arrId[$i]->id."' type='button' onClick='addToCart(this.id)'>Potvrdi</button>
                     </div>";
            }
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