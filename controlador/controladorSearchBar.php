<?php
    //Alba Matamoros Morales
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //Array d'errors.
    $errors = [];
    require_once './model/modelPaginacio.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>