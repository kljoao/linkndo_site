<?php

    $user_access='root';
    $password_acces='';
    $database='linkndo';
    $host='localhost';

    $mysqli = new mysqli($host, $user_access, $password_acces, $database);

    if($mysqli->error){
        die("Error to connect to database, try later.".$mysqli->error);
    }

?>