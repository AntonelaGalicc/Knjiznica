<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Methods:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
header('Access-Control-Allow-Methods:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../core/dbh.inc.php"; 
include_once "../core/knjige_db.php"; 

$nova_knjiga    = new Knjige($pdo);

$data = json_decode(file_get_contents("php://input"));

$nova_knjiga->naslov    = $data->naslov;
$nova_knjiga->godina    = $data->godina;
$nova_knjiga->autor_id  =$data->autor_id;

if ($nova_knjiga->add_knjige()){
	 echo json_encode(array('message'=> 'Knjiga je dodana!'));
}else{
 	echo json_encode(array('message'=> 'Greska kod dodavanja!'));
	 }