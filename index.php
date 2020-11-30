<?php
include 'inc/header.php';

if($session!=NULL){
    include 'inc/user-page.php';
}
else{
    include 'inc/slider.php';
    include 'inc/gallery-home.php';
    include 'inc/recent_uploads.php';
    include 'inc/top-uploaders.php';
}
include 'inc/footer.php';
?>