<?php
session_start();
$session =$_SESSION['user'];
$upload_folder = "uploads";
$user_folder = $upload_folder."/".$session;
$avatar_folder = $user_folder."/avatar";
$pic = 0;
$filetodelete = '';
$filename = $_FILES['avatar']['name'];
$tmpname = $_FILES['avatar']['tmp_name'];
$destination = "uploads/".$session."/avatar/".$filename;

move_uploaded_file($tmpname, $destination);

if($handle = opendir($avatar_folder)){
    while(false!== ($entry = readdir($handle))){
        if($entry!="." and $entry != ".." and $entry!=$filename) {
            $pic = 1;
            $filetodelete = $entry;
        }
    }
    closedir($handle);
}

if($pic == 1){
    if(unlink($avatar_folder."/".$filetodelete)){

    }
}
if($handle = opendir($avatar_folder)){
    while(false!== ($entry = readdir($handle))){
        if($entry!="." and $entry != "..") {

          echo $avatar_path =$avatar_folder . "/" . $entry;
        }
    }
    closedir($handle);
}