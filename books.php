<?php

//Book Tab Listing Books
function getBook() {
    $conn = connection();

    $query = "SELECT * FROM book ORDER BY title";
    $result = mysqli_query($conn, $query);
    $book = array();
    $i = 0;

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)):
            $book[] = $row;
        
            $response[$i]['book_id'] = $row['book_id'];
            $response[$i]['isbn10'] = $row['isbn10'];
            $response[$i]['book_cover'] = "<div class='bookArt'><img src='../../image/" . $row['book_cover'] . "' height='75%' width='75%'></div>";
            $response[$i]['category'] = $row['category'];
            $response[$i]['title'] = $row['title'];
            $response[$i]['book_name'] = $row['book_name'];
            $response[$i]['author'] = $row['author'];
            $response[$i]['description'] = $row['description'];
            $response[$i]['publisher'] = $row['publisher'];
            $response[$i]['publish_date'] = $row['publish_date'];
            $response[$i]['format'] = $row['format'];
            $response[$i]['language'] = $row['language'];
            $response[$i]['price'] = $row['price'];            
            $response[$i]['action'] = "<button class='btn btn-info btn-sm bookEdit' id='" . $row['book_id'] . "' name=" . $row['book_name'] . "><span class='glyphicon glyphicon-edit'></span></button>&nbsp;<button class='btn btn-danger btn-sm bookDel' id='" . $row['book_id'] . "'><span class='glyphicon glyphicon-trash'></span></button>";
            $data['posts'][$i] = $response[$i];
            $i = $i + 1;
        endwhile;
    }

    $json = json_encode($data['posts']);
    echo $json;
    mysqli_close($conn);
}

function editBook() {
    $conn = connection();

    $query = mysqli_query($conn, "SELECT * FROM book WHERE book_id = '" . $_POST['book_id'] . "';");
    $result = mysqli_fetch_assoc($query);

    echo json_encode(array('response' => $result));

    mysqli_close($conn);
}

function deleteBook() {
    $book_id = filter_input(INPUT_POST, 'book_id');

    $conn = connection();

    $query = "DELETE from book WHERE book_id = '$book_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(array('response' => 'success'));
    } else {
        echo json_encode(array('response' => 'sorry not deleted'));
    }

    mysqli_close($conn);
}

function updateBook() {
    $book_id = filter_input(INPUT_POST, 'book_id');
    $isbn = filter_input(INPUT_POST, 'isbn');
    $category = filter_input(INPUT_POST, 'category');
    $title = filter_input(INPUT_POST, 'title');
    $book_name = filter_input(INPUT_POST, 'name');
    $author = filter_input(INPUT_POST, 'author');
    $publisher = filter_input(INPUT_POST, 'publisher');
    $publish_date = filter_input(INPUT_POST, 'publish_date');
    $price = filter_input(INPUT_POST, 'price');
    $format = filter_input(INPUT_POST, 'format');
    $lang = filter_input(INPUT_POST, 'lang');

    $conn = connection();

    $query = "UPDATE `book` SET `isbn10`= '$isbn', `category`= '$category', `title`= '$title',"
            . "`book_name`= '$book_name', `author`= '$author', `publisher`= '$publisher', `publish_date`= '$publish_date', `price`= '$price',"
            . "`format`= '$format', `language`= '$lang' WHERE book_id= '$book_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(array('response' => 'success'));
    } else {
        echo json_encode(array('response' => 'sorry not updated'));
    }

    mysqli_close($conn);
}

?>