<?php

//Register user
function register() {
    $conn = connection();
    
    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $email = filter_input(INPUT_POST, 'email');
    $password = md5(filter_input(INPUT_POST, 'password'));
    $dob = filter_input(INPUT_POST, 'dob');
    $gender = filter_input(INPUT_POST, 'gender');    

    $emails = mysqli_query($conn, "SELECT email from user where email = '" . $email . "'");

    if (mysqli_num_rows($emails) == 0) {
        $query = "INSERT INTO user(fname, lname, email, password, dob, gender, user_type) VALUES ('$fname', '$lname', '$email', '$password', '$dob', '$gender', '1')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(array('response' => 'success'));
        } else {
            echo json_encode(array('response' => 'failed to process the query'));
        }
    } else {
        echo json_encode(array('response' => 'error'));
    }

    mysqli_close($conn);
}

//Login
function login() {
    $email = filter_input(INPUT_POST, 'email');
    $pass = md5(filter_input(INPUT_POST, 'password'));

    $conn = connection();
    $query = "SELECT * FROM user WHERE email = '" . $email . "' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);
    $data = mysqli_fetch_assoc($result);

    if ($row == 1) {
        if ($pass == $data['password']) {
            echo json_encode(array('response' => 'success', 'userdata' => $data));
        } else {
            echo json_encode(array('response' => "The password entered did not match!"));
        }
    } else {
        echo json_encode(array('response' => 'The email is not registered.'));
    }

    mysqli_close($conn);
}

?>