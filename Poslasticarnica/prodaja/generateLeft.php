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
    $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    if($input == 1){
        $prep = $db->prepare("SELECT DISTINCT posi.proizvodi.tip FROM posi.proizvodi
         WHERE posi.proizvodi.is_aktivan = ? ORDER BY(posi.proizvodi.tip) ASC;");//1
        $res = $prep->execute([1]);
        $categories = $prep->fetchAll(PDO::FETCH_OBJ);
        for($i = 0; $i<COUNT($categories); $i++){
            echo "<button type='button' id='".$categories[$i]->tip."' class='kategorije' onClick='generateCenter(this.id)'>".$categories[$i]->tip."</button>";
        }
    }
}
else{
    echo" <script type='text/javascript'>window.location.replace('../login/login.html');</script>" ;   
}

}
else{
    echo" <script type='text/javascript'>window.location.replace('../login/login.html');</script>" ;   
}
?>