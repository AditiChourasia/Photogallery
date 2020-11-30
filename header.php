<?php
@session_start();
if(isset($_SESSION['user'])){
    $session = $_SESSION['user'];
}
else{
    $session = NULL;
}
if(isset($_SESSION['user'])){
    $name = $_SESSION['name'] ;
}
else{
    $name = NULL;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style7.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/simpletextrotator.css">
    <link href="css/lightbox.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <a href="#" class="logo size36">Photo<span class="orange">G</span>allery</a>
                <nav>
                    <button class="btn" data-toggle="collapse" data-target="#menu">
                    <i class="fa fa-bars" aria-hidden="true"></i>    
                    </button>
                    <div class="collapse shift" id="menu">
                        <ul class="center black-bg">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="gallery.php">Gallery</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <?php if($session == NUll){ ?>
                            <li class="login"><a href="login.php">Login</a></li>
                            <li class="register "><a href="register.php">Register</a></li>
                                <li class="login"><a href="admin.php">Admin Login</a></li>
                            <?php }
                            else{ ?>
                            <li class="logout"><a href="inc/logout.php">Logout</a></li>
                            <?php }?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    <?php
    ?>
    </header>