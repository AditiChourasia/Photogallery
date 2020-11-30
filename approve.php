<?php
$picid = $_POST['id'];
include 'inc/db.php';
global $conn;
$approved = 1;
$query = "UPDATE pics SET approved='$approved' WHERE pid = '$picid'";
$query1 = "SELECT * FROM users WHERE username=(SELECT username FROM pics WHERE pid = '$picid')";
$run_query = $conn->query($query);
if($run_query){
    echo "Approved";
    $run_query1 = $conn->query($query1);
    while ($row = $run_query1->fetch_assoc()){
        $new_uploads = $row['uploads'] + 1;
        $query2 = "UPDATE users SET uploads ='$new_uploads' WHERE username = (SELECT username FROM pics WHERE pid = '$picid') ";
        $run_query2 = $conn->query($query2);
        if($run_query2){
            echo "done";
        }
        else{
            echo "Not done";
        }
    }
}
else{
    echo "Oops!";
}

?>