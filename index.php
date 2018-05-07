<?php

require 'conn.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Content-Type: application/json; charset=utf-8');

$methods = array(
    'user_register' => 'register',
    'user_login' => 'login',
    'late_user' => 'recentUser',
    'late_cmnt' => 'recentComment',
    'delete_cmnt' => 'deleteComment',
    'list_book' => 'getBook',
    'edit_book' => 'editBook',
    'update_book' => 'updateBook',
    'delete_book' => 'deleteBook',
    'user' => 'allUser',
    'delete_user' => 'delUser'
);

include 'functions.php';
include 'comments.php';
include 'books.php';
include 'users.php';

if (isset($_GET['method'])) {

    // get the value of the key from above decalred associative array
    //$method = $methods[$_GET['method']];
    // unset a superglobal variable. WHy???
    //unset($_GET['method']);
    
    // get the value of the key from above decalred associative array
    //$method = $methods[$_GET['method']];
    //unset($_GET['method']); // unset a superglobal variable. WHy???
    //
    //call_user_func_array($method, array($_GET));
    
    //call_user_func_array($method, array($_GET));
    
    // get the value of the key from above decalred associative array
    $method = $methods[$_GET['method']];
    unset($_GET['method']); // unset a superglobal variable. WHy???
    //
    call_user_func_array($method, array($_GET));
}

function queryResult($query) {
    $connection = connection();

    mysqli_query($connection, 'SET CHARACTER SET utf8');
    $result = mysqli_query($connection, $query);

    $result_array = array();
    while ($row = mysqli_fetch_assoc($result)):
        $result_array[] = $row;
    endwhile;
    $outcome = json_encode($result_array);
    mysqli_close($connection);
    return $outcome;
}
?>

