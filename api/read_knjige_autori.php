<?php
header('Access-Control-Allow-Origin:*'); 
header('Content-Type: application/json'); 
 
include_once "../core/dbh.inc.php";
include_once "../core/knjige_db.php";
include_once "../core/autori_db.php";

$knjige = new Knjige($pdo);

$poziv_metode = $knjige->read();

$brojac_redaka = $poziv_metode->rowCount();

if ($brojac_redaka > 0){
    $knjige_niz = array();
    $knjige_niz['response'] = array();

    while ($red = $poziv_metode->fetch(PDO::FETCH_ASSOC)) {
         if ($red) {
            extract($red);
            $knjige_red = array(
                'id'        =>$id,
                'naslov'    =>$naslov,
                'godina'    =>$godina,
                'autor_id'  =>$autor_id,
                'ime'       =>$ime,
            );

            if(!empty($prezime)){
                $knjige_red['prezime'] = $prezime;
            }
             array_push($knjige_niz['response'], $knjige_red);
        }
    }
     echo json_encode($knjige_niz);
} else {
    echo json_encode(array('message' => 'Nema podataka'));
    
}

?>