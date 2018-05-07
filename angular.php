<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "TheBookShop");

$result = $conn->query("SELECT * FROM contact ORDER BY msg_date DESC");

$outp = "";
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"name":"'  . $row["name"] . '",';
    $outp .= '"email":"'   . $row["email"]        . '"}';
    //$outp .= '"Country":"'. $row["Country"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);

//$conn = connection();
//
//$query = "SELECT * FROM contact ORDER BY msg_date DESC LIMIT 10";
//$result = mysqli_query($conn, $query);
//$comment = array();
//
//if (mysqli_num_rows($result) > 0) {
//    while ($row = mysqli_fetch_array($result)):
//        $comment[] = $row;
//    endwhile;
//}
//
//echo json_encode(array('response' => $comment));
//
//mysqli_close($conn);

?>

