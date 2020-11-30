<?php
$picid = $_POST['id'];
include 'inc/db.php';
global $conn;
$query = "DELETE FROM pics WHERE pid = '$picid'";
$run_query = $conn->query($query);
if($run_query){
    echo "Deleted!";
}
else{
    echo "Oops!";
}

?>