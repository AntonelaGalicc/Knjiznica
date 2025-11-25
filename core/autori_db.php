<?php 

include_once "../core/dbh.inc.php";

class Autori{
    public $id;
    public $ime;
    public $prezime;
    
    private $conn;

    public function __construct($pdo){
        $this->conn = $pdo;
    }

    public function read(){
        $query = "SELECT id
                        ,ime
                        ,prezime
                    FROM autori";
        
        $stmt = $this->conn->prepare($query);
        $stmt ->execute();
        return $stmt;
    }
    
        function add_autori(){
		$query = 'INSERT INTO autori (ime,prezime)
													VALUES (:ime,:prezime)';
			
		$stmt = $this->conn->prepare($query);
			
			
		$this->ime			        = htmlspecialchars(strip_tags($this->ime));
		$this->prezime 				= htmlspecialchars(strip_tags($this->prezime));
			
			
		$stmt->bindParam(':ime',	 		$this->ime);
		$stmt->bindParam(':prezime',	 	$this->prezime);

		if($stmt->execute()){
			return true;
		}
		else{
			printf("Greška prilikom unosa autora. " , $stmt->error);
			return false;
			}
        }

    function delete_knjiga_autor(){
        $query_knjige       = 'DELETE  FROM knjige WHERE autor_id = :autor_id';
        $stmt_knjige = $this->conn->prepare($query_knjige);
        $stmt_knjige->bindParam(':autor_id', $this->id);
        if (!$stmt_knjige->execute()) {
            return false;
    }

    $query_autor = "DELETE FROM autori WHERE id = :id";
    $stmt_autor = $this->conn->prepare($query_autor);
    $stmt_autor->bindParam(':id', $this->id);
    
    if ($stmt_autor->execute()) {
        return true;
    } else {
        return false;
    }
    }
}


?>