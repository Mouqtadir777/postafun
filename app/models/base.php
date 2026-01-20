<?php
 function db_chain(){
    $db= new PDO("mysql:host=localhost; dbname=postafun", "root", "Abiola2711." );
    return $db;
 }
?>