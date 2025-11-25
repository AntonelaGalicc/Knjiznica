<?php

   $dns = "mysql:host=127.0.0.1;port=3307;dbname=knjiznica";

    $dbusername = "root";
    $dbpassword = "";

   try{
        
     $pdo = new PDO($dns, $dbusername, $dbpassword);
        
     $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Povezivanje nije uspjelo." . $e->getMessage();
    }


?>