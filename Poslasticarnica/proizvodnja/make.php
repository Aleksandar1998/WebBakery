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
    $input = json_decode($input,true);
    $id = filter_var($input['id'],FILTER_SANITIZE_NUMBER_INT);
    $kolicinaProizvoda = filter_var($input['kolicina'],FILTER_SANITIZE_NUMBER_FLOAT);
    $ime = filter_var($input['ime'],FILTER_SANITIZE_STRING);
    $is_parce = filter_var($input['is_parce'],FILTER_VALIDATE_BOOLEAN);
    $prepInsert= $db->prepare("INSERT INTO posi.proizvodnja(posi.proizvodnja.proizvod_id, posi.proizvodnja.kolicina) VALUES (?,?);");//$id i $kolicinaProizvoda
    $resInsert = $prepInsert->execute([$id,$kolicinaProizvoda]);
    if($is_parce){
        //ako je torta parce vrednost se mnozi brojem parcica u kilogramu u konkretnom slucaju to je 8 (1000/8 = 125g)
        $kolicinaProizvoda *= 8;
    }
    //dodavanje proizvoda na stanje u tabelu koja ce se koristiti za prodaju
    $prepUpdateProizvodKolicina = $db->prepare("UPDATE posi.proizvodkolicina SET posi.proizvodkolicina.kolicina = posi.proizvodkolicina.kolicina + ? WHERE posi.proizvodkolicina.proizvod_id = ?;");//$kolicinaProizvoda ii $id
    $resUpdateProizvodKolicina = $prepUpdateProizvodKolicina->execute([$kolicinaProizvoda,$id]);
    if($is_parce){

        $kolicinaProizvoda /=8; //vraćanje kolicine iz parcadi u kilograme da bi se torta u kilogramima koristila prilikom odredjivanja udela sirovine u njemu
    }

    //proizvod_magacin id i kolicina
    $prepSelectMagacinID = $db->prepare("SELECT posi.proizvod_magacin.magacin_id, posi.proizvod_magacin.kolicina FROM posi.proizvod_magacin WHERE posi.proizvod_magacin.proizvod_id = ?;");//$id
    $resSelectMagacinID = $prepSelectMagacinID->execute([$id]);
    $arrayID = $prepSelectMagacinID->fetchAll(PDO::FETCH_OBJ);//niz koji sadrži ID sirovina i kolicinu koje ce biti umanjene iz magacina
    $arrayMk = [];
    //selektovanje kolicine koja se nalazi na zalihama po redosledu u kojem su sirovine navedene u tabeli proizvod_magacin
    $prepSelectMK = $db->prepare("SELECT posi.magacin.kolicina FROM posi.magacin WHERE posi.magacin.magacin_id = ?;");//$arrayID[$i]->magacin_id
    for($i=0; $i < COUNT($arrayID);$i++){
        $res = $prepSelectMK->execute([$arrayID[$i]->magacin_id]);
        $arrayMk[] = $prepSelectMK->fetch(PDO::FETCH_OBJ);
    }
    //umanjivanje kolicine dohvaćene iz baze
    for($i = 0 ; $i < COUNT($arrayMk);$i++){
        $kolicinaMagacina = $arrayMk[$i]->kolicina;
        $udeoRecepta = $arrayID[$i]->kolicina;
        $umanjilac = $udeoRecepta*$kolicinaProizvoda;
        $kolicinaMagacina -= $umanjilac;
        $arrayMk[$i]->kolicina = $kolicinaMagacina;
    }
    
    //update sirovina u magacinu
    $prepUpdate = $db->prepare("UPDATE posi.magacin SET posi.magacin.kolicina = ? WHERE posi.magacin.magacin_id = ?;");//$arrayMk[$i]->kolicina i $id
    for($i = 0; $i < COUNT($arrayMk); $i++){
        if($arrayMk[$i]->kolicina < 0){
            $arrayMk[$i]->kolicina = 0;

        }
        $resUpdate = $prepUpdate->execute([$arrayMk[$i]->kolicina, $arrayID[$i]->magacin_id]);
    }
    $prepNaStanju = $db->prepare("UPDATE posi.magacin SET posi.magacin.na_stanju = ? WHERE posi.magacin.kolicina = ?;");
    $resNaStanjue = $prepNaStanju->execute([0,0]);

    echo "Proizvodnja ".$kolicinaProizvoda." kilograma ".$ime." je ubeležena u bazi podataka";

}
else{
    echo" <script type='text/javascript'>alert('Nemate autorizaciju za pristup ovoj stranici, prijavite se, pa pokušajte opet.');window.location.replace('../login/login.html');</script>" ; 
}
?>