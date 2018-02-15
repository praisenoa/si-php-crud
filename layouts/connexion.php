<?php 
try {
    $conn = new PDO('mysql:dbname=si_php;host=localhost;port=8889', 'root', 'root');
} catch (PDOException $exception) {
    die($exception->getMessage());
}
