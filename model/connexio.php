<?php
//Alba Matamoros Morales

//CONNEXIO
    function connexio(){
    //Dades connexio a BD.
    $host = "localhost";
    $nomBD = "pt04_alba_matamoros";
    $usuari = "root";
    $contra = "";

    //Connexió.
    try {
        $connexio = new PDO("mysql:host=$host;dbname=$nomBD", $usuari, $contra);
        return $connexio;
        //echo "Connexio correcta!!" . "<br />"; 
    } catch (PDOException $e){
        die("Error: " . $e->getMessage());
    }
    }
?>