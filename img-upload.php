<?php
include 'inc/db.php';
session_start();
$session =$_SESSION['user'];

$pic = 0;
$filetodelete = '';
$filename = $_FILES['new-file']['name'];
$tmpname = $_FILES['new-file']['tmp_name'];
$destination = "uploads/".$session."/".$filename;


$id='';
$approved = 0;
$query = "INSERT into pics values('$id', '$session', '$filename', '$approved' )";
$run_query = $conn->query($query);

if($run_query){
    if(move_uploaded_file($tmpname, $destination)){
        echo ($destination);
    }
}

?>