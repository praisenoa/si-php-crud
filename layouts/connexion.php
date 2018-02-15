<?php 
    try {
        $conn = new PDO('mysql:dbname=databaseSI;host=localhost', 'root', '');
    } catch (PDOException $exception) {
        die($exception->getMessage());
    }
?>