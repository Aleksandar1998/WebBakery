<?php 

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../../../error/fourOfour.php");
    die();
    
}
function getMinDate($db){
    $prep = $db->prepare('SELECT posi.proizvodnja.datum FROM posi.proizvodnja ORDER BY(posi.proizvodnja.datum) ASC LIMIT 1;');
    $prep->execute([]);
    $obj =  $prep->fetch(PDO::FETCH_OBJ);
    return $obj;
}
function getMaxDate($db){
    $prep = $db->prepare('SELECT posi.proizvodnja.datum FROM posi.proizvodnja ORDER BY(posi.proizvodnja.datum) DESC LIMIT 1;');
    $prep->execute([]);
    return $prep->fetch(PDO::FETCH_OBJ);
}

function getProducedAmount($dateStart, $dateEnd, $db){
    $prep = $db->prepare("SELECT posi.proizvodi.ime, SUM(posi.proizvodnja.kolicina) AS Kolicina
                          FROM posi.proizvodi LEFT JOIN posi.proizvodnja ON posi.proizvodi.proizvod_id = posi.proizvodnja.proizvod_id
                          WHERE DATE(posi.proizvodnja.datum) BETWEEN ?  AND ? GROUP BY(posi.proizvodnja.proizvod_id);
                          ");
    $prep->execute([$dateStart, $dateEnd]);

    return $prep->fetchAll(PDO::FETCH_OBJ);

}
?>
