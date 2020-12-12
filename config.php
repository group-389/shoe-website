<?php
    define('USER', 'root'); //replace with coresponding info
    define('PASSWORD', '');//replace with coresponding info
    define('HOST', 'localhost');//replace with coresponding info
    define('DATABASE', 'shoeshop');
    try {
        $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD); //initiate connection to database
    } catch (PDOException $e) { //catch incorrect entry
        exit("Error: " . $e->getMessage()); //error message for issue connecting to database
        }
?>



