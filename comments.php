<?php

//Admin Dash, viewing recent comments
function recentComment() {
    $conn = connection();

    $query = "SELECT * FROM contact ORDER BY msg_date DESC";
    $result = mysqli_query($conn, $query);
    $comment = array();
    $i = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)):
            $comment[] = $row;
            
            $response[$i]['name'] = $row['name'];
            $response[$i]['email'] = $row['email'];
            $response[$i]['phone'] = $row['phone'];
            $response[$i]['comment'] = $row['comment'];
            $response[$i]['action'] = "<button class='btn btn-danger btn-sm comment_del' id='" . $row['contact_id'] . "'><span class='glyphicon glyphicon-trash'></span></button>";
            $data['posts'][$i] = $response[$i];
            $i = $i + 1;
        endwhile;
    }
    $json = json_encode($data['posts']);
    echo $json;
    //echo json_encode(array('response' => $comment));
    mysqli_close($conn);
}

function deleteComment(){
    $conn = connection();
    
    $id = filter_input(INPUT_POST, 'cmnt_id');

    $query = mysqli_query($conn, "DELETE FROM contact WHERE contact_id = '" . $id . "'");
    if ($query) {
        echo json_encode(array('response' => 'success'));
    } else {
        echo json_encode(array('response' => 'Sorry property was not deleted'));
    }
    mysqli_close($conn);
}
?>