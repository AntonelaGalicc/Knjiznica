<?php 

include_once "../core/dbh.inc.php";

class Knjige{
    public $id;
    public $naslov;
    public $godina;
    public $autor_id;
    
    private $conn;

    public function __construct($pdo){
        $this->conn = $pdo;
    }

    public function read(){
        $query = "SELECT k.id, k.naslov, k.godina, k.autor_id, a.ime, a.prezime
                    FROM knjige k
                        JOIN autori a ON k.autor_id = a.id
                    ORDER BY k.godina ASC;
                    ";
        
        $stmt = $this->conn->prepare($query);
        $stmt ->execute();
        return $stmt;
    }


        function add_knjige(){
			$query = 'INSERT INTO knjige (naslov,godina,autor_id)
													 VALUES (:naslov,:godina,:autor_id)';
			
			$stmt = $this->conn->prepare($query);
			
			
			$this->naslov			        = htmlspecialchars(strip_tags($this->naslov));
			$this->godina 				    = htmlspecialchars(strip_tags($this->godina));
			$this->autor_id 		        = htmlspecialchars(strip_tags($this->autor_id));

			
			$stmt->bindParam(':naslov',	 		$this->naslov);
			$stmt->bindParam(':godina',	 		$this->godina);
			$stmt->bindParam(':autor_id', 		$this->autor_id);

			if($stmt->execute()){
				return true;
			}
			else{
				printf("Greška prilikom unosa knjige. " , $stmt->error);
				return false;
			}


	}
}


?>