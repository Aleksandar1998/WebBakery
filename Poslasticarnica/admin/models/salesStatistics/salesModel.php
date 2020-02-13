<?php 
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../../../error/fourOfour.php");
    die();
    
}
function getMinDate($db){
    $prep = $db->prepare('SELECT posi.prodaja.datum FROM posi.prodaja ORDER BY(posi.prodaja.datum) ASC LIMIT 1;');
    $prep->execute([]);
    $obj =  $prep->fetch(PDO::FETCH_OBJ);
    return $obj;
}
function getMaxDate($db){
    $prep = $db->prepare('SELECT posi.prodaja.datum FROM posi.prodaja ORDER BY(posi.prodaja.datum) DESC LIMIT 1;');
    $prep->execute([]);
    return $prep->fetch(PDO::FETCH_OBJ);
}

function getEarnings($dateStart, $dateEnd, $db){
    $prep = $db->prepare("SELECT  DATE(posi.prodaja.datum) AS Datum, SUM(posi.prodaja.ukupno) as Ukupno 
                          FROM posi.prodaja WHERE DATE(posi.prodaja.datum)
                          BETWEEN  ? AND ? GROUP BY(Date(posi.prodaja.datum));");//dateStart dateEnd
    $prep->execute([$dateStart, $dateEnd]);
    return $prep->fetchAll(PDO::FETCH_OBJ);
}

function getSoldAmount($dateStart, $dateEnd, $db){
    $prep = $db->prepare("SELECT posi.proizvodi.ime, SUM(posi.prodaja.kolicina) AS Kolicina
                          FROM posi.proizvodi LEFT JOIN posi.prodaja ON posi.proizvodi.proizvod_id = posi.prodaja.proizvod_id
                          WHERE DATE(posi.prodaja.datum) BETWEEN ? AND ? GROUP BY(posi.prodaja.proizvod_id);
    ");
    $prep->execute([$dateStart, $dateEnd]);

    return $prep->fetchAll(PDO::FETCH_OBJ);

}
?>
