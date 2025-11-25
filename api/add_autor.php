<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Methods:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
header('Access-Control-Allow-Methods:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../core/dbh.inc.php"; 
include_once "../core/autori_db.php"; 

$autori    = new Autori($pdo);

$data = json_decode(file_get_contents("php://input"));

$autori->ime        = $data->ime;
$autori->prezime    = $data->prezime;

if ($autori->add_autori()){
	 echo json_encode(array('message'=> 'Autor dodan!'));
}else{
 	echo json_encode(array('message'=> 'Greska kod dodavanja!'));
	 }