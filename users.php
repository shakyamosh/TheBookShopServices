<?php

function recentUser() {
    $conn = connection();

    $query = "SELECT * FROM user ORDER BY date_created DESC LIMIT 10";
    $result = mysqli_query($conn, $query);
    $user = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)):
            $user[] = $row;
        endwhile;
    }

    echo json_encode(array('response' => $user));
    mysqli_close($conn);
}

function allUser() {
    $conn = connection();

    $query = "SELECT * FROM user ORDER BY date_created";
    $result = mysqli_query($conn, $query);
    $user = array();
    $i = 0;

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)):
            $user[] = $row;

            $response[$i]['fname'] = $row['fname'];
            $response[$i]['lname'] = $row['lname'];
            $response[$i]['email'] = $row['email'];
            $response[$i]['dob'] = $row['dob'];

            $response[$i]['user_type'] = $row['user_type'];
            $visibility = '';
            if ($row['user_type'] == '1') {
                $visibility = "<span class='label label-success'>User</span>";
            } else {
                $visibility = "<span class='label label-danger'>Admin</span>";
            }
            $response[$i]['visibility'] = $visibility;

            $response[$i]['action'] = " <button class='btn btn-danger btn-sm user_delete' id='" . $row['user_id'] . "'><span class='glyphicon glyphicon-trash'></span></button>";
            $data['posts'][$i] = $response[$i];
            $i = $i + 1;
        endwhile;
    }

    $json = json_encode($data['posts']);
    echo $json;
    mysqli_close($conn);

//    echo json_encode(array('response' => $user));
//    mysqli_close($conn);
}

function delUser() {
    $conn = connection();
    
    $id = filter_input(INPUT_POST, 'id');

    $query = mysqli_query($conn, "DELETE FROM user WHERE user_id = '" . $id . "'");
    if ($query) {
        echo json_encode(array('response' => 'success'));
    } else {
        echo json_encode(array('response' => 'Sorry property was not deleted'));
    }
    mysqli_close($conn);
}
