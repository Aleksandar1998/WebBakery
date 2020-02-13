<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../error/fourOfour.php");
    die();
    
}
define('PRISTUP', TRUE);
require_once '../baza.php';
$input = file_get_contents("php://input");

$js = (json_decode($input,true));
$username = filter_var($js['username'], FILTER_SANITIZE_STRING);
$prepHash = $db->prepare('SELECT posi.users.password FROM posi.users WHERE posi.users.ime = ?');
$prepHash->execute([$username]);
$hash = $prepHash->fetch(PDO::FETCH_OBJ);

if($hash){
    $pass = filter_var($js['pass'],FILTER_SANITIZE_NUMBER_INT);
    if(password_verify($pass,$hash->password)){
        $prep = $db->prepare('SELECT posi.users.jedinica FROM posi.users WHERE posi.users.ime = ?;');
        $prep->execute([$username]);
        $id = $prep->fetch(PDO::FETCH_OBJ);
        if($id->jedinica== -1){
            session_start();
             $_SESSION['admin'] = -1;
             echo -1;
         }
         if($id->jedinica == 0){
            session_start();
             $_SESSION['magacin'] = 0;
             echo 0;
         }
         if($id->jedinica == 1){
            session_start();
             $_SESSION['proizvodnja'] = 1;
             echo 1;
         }
         if($id->jedinica == 2){
            session_start();
             $_SESSION['radnja1'] = 2;
             echo 2;
         }
        
    }
    else{
        die(header("HTTP/1.0 400 Lozinka nije ispravna"));
    }
}
else{
    die(header("HTTP/1.0 400 Korisnik sa imenom '{$username}' nije pronadjen."));
}

?>