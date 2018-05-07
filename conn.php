<?php
function connection(){
    $hostname = "localhost";
    $user = "root";
    $pass = "";
    $database = "TheBookShop";
    
    return mysqli_connect($hostname, $user, $pass, $database);
}
?>
