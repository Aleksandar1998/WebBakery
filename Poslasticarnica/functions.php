<?php
if(!defined('PRISTUP')) {
    header("Location: error/fourOfour.php");
    die();
 }
function selectTip($input){

    require_once 'baza.php';
    $prep = $db->prepare("SELECT DISTINCT(posi.magacin.tip) FROM posi.magacin ORDER BY posi.magacin.tip;");
    $prep->execute([]);
    $tip = $prep->fetchAll(PDO::FETCH_OBJ);
    if(!empty($tip)){
        foreach($tip as $t){
            echo "<option id='".$t->tip.$input."'>".$t->tip."</option>";

        }

    }
    

}

?>