<?php

    $servername = "localhost";
    $username = "root";
    $password = "keklelkek";
    $db = "wiki-cities";
    $connection = mysqli_connect($servername, $username, $password, $db);

    if(!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>