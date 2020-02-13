<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../error/fourOfour.php");
    die();
    
}
define('PRISTUP', TRUE);
require_once('../baza.php');
if(isset($_SESSION['proizvodnja']) && $_SESSION['proizvodnja']==1){

    $input = file_get_contents("php://input");
    $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);

    if($input == 1){
        $prep = $db->prepare("SELECT posi.proizvodi.ime, posi.proizvodi.proizvod_id AS 'id' FROM posi.proizvodi WHERE posi.proizvodi.is_aktivan = ?;");
        $res = $prep->execute([1]);
        $proizvodi = $prep->fetchAll(PDO::FETCH_OBJ);
        foreach($proizvodi as $proizvod){
            echo "
                    <div id='proizvod".$proizvod->id."' class = 'element'>
                        <span id='ime".$proizvod->id."'>".$proizvod->ime."</span>
                        <input id='kolicina".$proizvod->id."' type='number' placeholder = 'Unesite količinu (max=99kg)' onFocusOut='check(this.id)'></input>
                        <button id='".$proizvod->id."' type='button' onClick='make(this.id)'>Potvrdi</button>
                    </div>
                    
            ";
        }
    }


}
else{
    echo" <script type='text/javascript'>alert('Nemate autorizaciju za pristup ovoj stranici, prijavite se, pa pokušajte opet.');window.location.replace('../login/login.html');</script>" ; 
}

?>