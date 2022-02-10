<?php
$username = 'aldi';
$password = 'klevi123';
$host = '127.0.0.1';
$database = 'art_store';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$database;charset=$charset";

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $err) {
    echo $err->getMessage().'<br>';
    return false;
}


// general function to save data into the database
function insertData($userData,$table) {
    try {
        global $pdo;
        $map_func = function($el) {
            return ":$el";
        };
        $keys = implode(", ", array_keys($userData));
        $values = implode(", ", array_map($map_func, array_keys($userData)));
        $sql = "INSERT INTO `$table` ($keys) VALUES ($values);";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute($userData);
        return true;
    } 
    catch (PDOException $err) {
        echo $err -> getMessage().'<br>';
        return false;
    }
}

function sqlQuery($sql){
    try {
        global $pdo; 
        return $pdo->query($sql);
    } catch (PDOException $err) {
        return array();
    }
}



?>