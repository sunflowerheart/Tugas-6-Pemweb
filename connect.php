<?php
function connection() {
    
    $dbhost = 'localhost';
    $dbUser = 'root';
    $dbPass = "";
    $dbName = "classicmodels";

    $conn = mysqli_connect($dbhost, $dbUser, $dbPass);

    if($conn) {
        $open = mysqli_select_db($conn, $dbName);
        echo "Database Tersambung";
        if (! $open) {
            echo "Database Tidak Dapat Tersambung";
        }
        return $conn;

    } else {
        echo "MySQL Tidak Tersambung";
    }
}
?>