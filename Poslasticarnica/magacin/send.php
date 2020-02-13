<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Location: ../error/fourOfour.php");
    die();
    
}
header('Content-type: text/html; charset=utf-8');
define('PRISTUP', TRUE);
require_once '../baza.php';
if(isset($_SESSION['magacin'])){
    if($_SESSION['magacin']==0){
		$input = file_get_contents("php://input");
		$checkFinal = filter_var($input, FILTER_SANITIZE_STRING);
		if($checkFinal == 'final'){
    		$same = fopen("same.txt","r");
    		$var = fgets($same) or die("File corrupted!");
			fclose($same);
			

    		$prepGet = $db->prepare("SELECT posi.prijempomocna.ime, posi.prijempomocna.tip, posi.prijempomocna.kolicina FROM posi.prijempomocna;");
			$prepGet->execute([]);
			$getAllPomocna = $prepGet->fetchAll(PDO::FETCH_OBJ);//niz koji sadrzi vrednosti iz pomocne tabele
			$prepInsert = $db->prepare("INSERT INTO posi.prijem (posi.prijem.ime,posi.prijem.tip,posi.prijem.kolicina,posi.prijem.same) VALUES (?,?,?,?);");//ime,tip,kolicina,var
			$arrayKolicina = []; //niz koji sadrzi kolicine dohvaćene iz baze podataka ako je sirovina već u bazi
			$insertArray   = [];//niz u kome ce se sadrzati vrednosti za koje predstavljaju nov zapis
			$prepSelectKolicina = $db->prepare("SELECT posi.magacin.kolicina FROM posi.magacin WHERE posi.magacin.ime = ?");//ime

			for($i=0; $i<COUNT($getAllPomocna); $i++){
				$prepInsert->execute([$getAllPomocna[$i]->ime, $getAllPomocna[$i]->tip, $getAllPomocna[$i]->kolicina, $var]);//logovanje prijema

				$prepSelectKolicina->execute([$getAllPomocna[$i]->ime]);
				$kolicina = null;
				$kolicina = $prepSelectKolicina->fetch(PDO::FETCH_OBJ);
				if($kolicina != null){
				$arrayKolicina[] = $kolicina->kolicina;
				}
				if($kolicina == null){
					$insertArray[] = $getAllPomocna[$i];
					unset($getAllPomocna[$i]);
				}
				
			}

			if(!empty($getAllPomocna)){//ako getAllPomocna nije prazan to znaci da imamo podudaranje za sirovinama na stanju i onda vrsimo update kolicine
				$prepUpdateMagacin = $db->prepare("UPDATE posi.magacin SET posi.magacin.kolicina = ?, posi.magacin.na_stanju = ? WHERE posi.magacin.ime = ?;");// kolicina, 1 ,ime
				for($i = 0; $i<COUNT($getAllPomocna); $i++){
					$kolicina = $getAllPomocna[$i]->kolicina + $arrayKolicina[$i];
					$prepUpdateMagacin->execute([$kolicina, 1, $getAllPomocna[$i]->ime]);
				}
			}

			if(!empty($insertArray)){// dodavanje novih proizvoda
				$prepInsertMagacin = $db->prepare("INSERT INTO posi.magacin (posi.magacin.ime, posi.magacin.tip, posi.magacin.kolicina, posi.magacin.na_stanju) 
									   VALUES (?,?,?,?);");//ime tip kolicina 1
				foreach($insertArray as $novi){
					$prepInsertMagacin->execute([$novi->ime, $novi->tip, $novi->kolicina, 1]);
				}
			}
 		$var++;
 		$same = fopen("same.txt","w");
 		fwrite($same,$var);
 		fclose($same);

 	}




		else{
			$array = json_decode($input,true);//niz koji sadrzi vrednosti poslane putem javascripta (ime, tip, kolicina) moze sadrzati 
			$prepTruncate = $db->prepare("TRUNCATE posi.prijempomocna;");
			$prepTruncate->execute([]);
			$prepInsert = $db->prepare("INSERT INTO posi.prijempomocna (posi.prijempomocna.ime,posi.prijempomocna.tip,posi.prijempomocna.kolicina) VALUES (?, ?, ?);");//i j k
			//Upis podataka u pomocnu tabelu
			 for($i = 0, $j = 1, $k = 2 ;$k<=count($array,COUNT_NORMAL);$i+=3,$j+=3,$k+=3){
				$ime = filter_var($array[$i], FILTER_SANITIZE_STRING);
				$tip = filter_var($array[$j], FILTER_SANITIZE_STRING);
				$kolicina = filter_var($array[$k], FILTER_SANITIZE_NUMBER_FLOAT);
				$prepInsert->execute([$ime,$tip,$kolicina]);
				}
				//Ispis podataka korisniku
				$prepGet = $db->prepare("SELECT * FROM posi.prijempomocna ORDER BY(posi.prijempomocna.prijemPomocna_id);");
				$prepGet->execute([]);
				$getAll  = $prepGet->fetchAll(PDO::FETCH_OBJ);
				foreach($getAll as $get){
				   echo"
					   <div id = 'tabela".$get->prijempomocna_id."'>
						   <span >".$get->ime."</span>
						   <span>".$get->tip."</span>
						   <span>".$get->kolicina." Kg</span>
						   <button type='button' id='btn".$get->prijempomocna_id."' onClick = 'obrisi(this.id)'>Obriši</button>
					   </div>";
	   
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