<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function conetarDB() {
    $host = "b0v8cdfuietbq1fj0pmx-mysql.services.clever-cloud.com";
    $database = "b0v8cdfuietbq1fj0pmx";
    $user = "uivkadk6peiudhhb";
    $pass = "DVwUlCzEVZRlkGvYD6r6";

    try {
        $con = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        return $con;
    } catch (PDOException $e) {
        die("ERROR: No se pudo conectar a la base de datos. " . $e->getMessage());
    }
}
 function recogerValor($key){
    return isset($_POST[$key]) ? trim(htmlspecialchars($_POST[$key])) : "error";
}
    ?>