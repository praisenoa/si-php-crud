<?php 
try {
    $conn = new PDO('mysql:dbname=databaseSI;host=127.0.0.1;port=3306', 'root', 'yourpassword');
} catch (PDOException $exception) {
    die($exception->getMessage());
}
