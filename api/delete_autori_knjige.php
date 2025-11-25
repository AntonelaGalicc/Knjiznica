<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Methods:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); 
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

include_once "../core/dbh.inc.php"; 
include_once "../core/autori_db.php"; 


	
	$autori = new Autori($pdo);

	if (isset($_GET['id']) && !empty($_GET['id'])) {
        $autori->id = $_GET['id'];
    } 
    
    else {
        $data = json_decode(file_get_contents("php://input"));
        $autori->id = isset($data->id) ? $data->id : null;
    }


    if (empty($autori->id)) {
        echo json_encode(array('message' => 'Greška: ID autora za brisanje nije poslan!'));
        exit;
    }
    if ($autori->delete_knjiga_autor()){
			echo json_encode(array('message'=> 'Obrisano!'));
			}
	else{
			echo json_encode(array('message'=> 'Greška kod brisanja!'));
			}
    
	
?>