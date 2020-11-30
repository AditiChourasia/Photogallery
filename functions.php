<?php
include "inc/db.php";

function get_top_uploaders(){
    global $conn;
    $limit = 3;
    $pic = 0;
    $query = "SELECT * FROM users ORDER BY uploads DESC LIMIT $limit";
    $run_query = $conn->query($query);

    if($run_query->num_rows>0){
        while ($row = $run_query->fetch_assoc()){
            $author = $row['username'];
            $avatar_folder = "uploads/".$author."/avatar";
        /**** File Handling ***/
            if($handle = opendir($avatar_folder)){
                while(false!== ($entry = readdir($handle))){
                    if($entry!="." and $entry != "..") {
                        $pic = 1;
                        if($pic==1)
                        {
                            $avatar_path = $avatar_folder.'/'.$entry;
                            ?>
                            <div class="col-md-4 image">
                                <div class="image_show">
                                    <img style="border: 1.5px #ff7c1f; border-style: solid; "
                                         src="<?php echo $avatar_path; ?>" class="image_show">
                                </div>
                                <div class="user-content">
                                    <div class="user-info">
                                        <h3><?php echo $author; ?></h3>
                                        <h6><i>Number of Uploads:</i> <?php echo $row['uploads']; ?></h6>

                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                }
                closedir($handle);
            }
            if($pic==0){
                ?>
                <div class="col-md-4 image">
                    <div class="image_show">
                        <img style="border: 1.5px #ff7c1f; border-style: solid; " src="img/user-default.jpg" class="image_show">
                    </div>
                    <div class="user-content">
                        <div class="user-info">
                            <h3><?php echo $author; ?></h3>
                            <h6><i>Number of Uploads</i> <?php echo $row['uploads']; ?></h6>

                        </div>
                    </div>
                </div>
                <?php
            }

        }
    }
}

function get_recent_pics(){
    global $conn;
    $limit = 3;
    $query = "SELECT * FROM pics ORDER BY pid DESC LIMIT $limit ";
    $run_query = $conn->query($query);
    if(mysqli_num_rows($run_query)>0){
        while ($row = $run_query->fetch_assoc()){
            $picname = $row['picname'];
            $pid = $row['pid'];
            $author = $row['username'];
            $src = "uploads/".$author."/".$picname;
            ?>
            <div class="col-md-4 flip-card">
                <div class="front">
                    <img src="<?php echo $src; ?>">
                </div>
                <div class="back">
                    <div class="back-content">
                        <h3><?php echo $picname; ?></h3>
                        <h6><i>by</i> <?php echo $author; ?></h6>

                    </div>
                </div>
            </div>
            <?php
        }
    }
}

function get_home_gallery_content($x){
    global $conn;

    $approved = 1;
    $new_query = "SELECT * FROM pics WHERE approved = '$approved' LIMIT $x;";
    $run_newquery = $conn->query($new_query);
    if(mysqli_num_rows($run_newquery) > 0) {
        while ($row = mysqli_fetch_assoc($run_newquery)){
            $picname = $row['picname'];
            $pid = $row['pid'];
            $author = $row['username'];
            $src = 'uploads/'.$author."/".$picname;
            ?>
            <div class="col-md-4 flip-card">
                <div class="front">
                    <img  src="<?php echo $src; ?>">
                </div>
                <div class="back">
                    <div class="back-content">
                        <h3><?php echo $picname; ?></h3>
                        <h6><i>by</i> <?php echo $author; ?></h6>

                    </div>
                </div>
            </div>
            <?php
        }
    }
}

function get_gallery_content(){
    global $conn;
    if(isset($_GET['page'])){
        $page = (int)$_GET['page'];
    }
    else{
        $page = (int)$_GET['page'] = 1;
    }
    if(isset($_GET['per_page']) && ($_GET['per_page'])<21){
        $per_page = $_GET['per_page'];
    }
    else{
        $per_page = $_GET['per_page'] = 9;
    }
    $approved = 1;
    $query = " SELECT * FROM pics WHERE approved = '$approved'";
    $run_query = $conn->query($query);
    $result = mysqli_num_rows($run_query);
    $pages = ceil($result/$per_page);
//    echo $pages;
    $start = ($page*$per_page)-$per_page;
    $new_query = "SELECT * FROM pics WHERE approved = '$approved' /* LIMIT $start, $per_page*/ ;";
    $run_newquery = $conn->query($new_query);
    if(mysqli_num_rows($run_newquery) > 0) {
        while ($row = mysqli_fetch_assoc($run_newquery)){
            $picname = $row['picname'];
            $pid = $row['pid'];
            $author = $row['username'];
            $src = 'uploads/'.$author."/".$picname;
            ?>
            <div class="col-md-4 flip-card">

                <div class="front">
                    <img  src="<?php echo $src; ?>">
                </div>
                    <div class="back">
                        <div class="back-content">
                        <h3><?php echo $picname; ?></h3>
                        <h6><i>by</i> <?php echo $author; ?></h6>

                    </div>
                    </div>

            </div>
            <?php
        }
    }
    ?>
    <!--<div class="page" style="display: flex;">-->
<!--    <div class="pagination123" style=" position: relative; color:#000; font-size:28px; margin: 2rem; z-index: 999;">-->
<!--       Page-->
<!--        --><?php //for($i=1; $i<=$pages; $i++){
//        ?>
<!--        <a style="background-color: rgba(0,0, 0,0.9); margin-left: 0.7cm; padding-right: 10px; padding-left: 10px; " href="?page=--><?php //echo $i;?><!--&per_page=--><?php //echo $per_page ?><!--" >--><?php //echo $i;?><!--</a>-->
<!--        --><?php
//    }?>
<!--    </div>-->
<!--</div>-->


    <?php
}

function get_profile_info($username){
    global $conn;
    $profile = "SELECT * FROM users WHERE username = '$username'";
    $runqueryprofile = $conn->query($profile);

    $row = $runqueryprofile->fetch_assoc();

    echo "Name :".$row['fname']." ".$row['lname']."<br>"."Username :     ".$row['username']."<br>"."Email-address : ".$row['email']."<br>".
        " Bio : ".$row['bio'];
}
function update_profile($username, $fname, $lname, $newusername, $email, $bio){

    global $conn;
    $update = "UPDATE users SET fname = '$fname', lname = '$lname', username = '$newusername', email = '$email', bio = '$bio' WHERE username = '$username'";
    if($conn->query($update)== true){
        echo "good";
    }
else{
    echo "not done";
}
}

function sanitize($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function get_avatar_image($name) {
    $pic = 0;
    $upload_folder = "uploads";
    $user_folder = $upload_folder."/".$name;
    $avatar_folder = $user_folder."/avatar";

    if(is_dir($upload_folder)){
        if(is_dir($user_folder)){

        }
        else{
            mkdir($user_folder);
        }
    }
    else{
        mkdir($upload_folder);
        if(is_dir($user_folder)){

        }
        else{
            mkdir($user_folder);
        }
    }
    if(is_dir($avatar_folder)){

    }
    else{
        mkdir($avatar_folder);
    }
    if($handle = opendir($avatar_folder)){
        while(false!== ($entry = readdir($handle))){
            if($entry!="." and $entry != "..") {
                $pic = 1;
                $avatar_path = "uploads/".$name."/avatar/".$entry;
                echo "<img src='$avatar_path' alt='$entry' id='avatar-id' class='user-image' style='border: solid white 1px;'>";
            }
        }
        closedir($handle);
    }
    if($pic == 0){
        echo "<img src='img/user-default.jpg' class='user-image' id='avatar-id' >";
    }

}
function get_user_uploaded_pics($username){
    global $conn;
    $query = "SELECT * FROM pics WHERE username = '$username' order by pid desc";
    $run_query = $conn->query($query);

    if(mysqli_num_rows($run_query)>0)
    {
        while($row = $run_query->fetch_assoc())
        {
            $picid = $row['pid'];
            $picname = $row['picname'];
            $path = 'uploads/'.$username.'/'.$picname;
            ?>
            <div class="gallery col-xl-4 col-lg-4 col-md-4">
                <img class="gallery-img" src="<?php echo $path; ?>">
            </div>
<?php
        }
    }
}
function get_unapproved_pics(){
    global $conn;
    $query = "SELECT * FROM pics WHERE approved = 0";
    $run_query = $conn->query($query);
    if(mysqli_num_rows($run_query)>0){
        while($row = $run_query->fetch_assoc()){
            $pid = $row['pid'];
            $picname = $row['picname'];
            $username = $row['username'];
            $src = "uploads/".$username."/".$picname;
            ?>
            <div id="row-<?php echo $pid; ?>">
                <div style="float:left;" class="col-md-4 col-xl-4">
                    <img class="gallery-img" src="<?php echo $src; ?>" id="<?php echo $pid; ?>">
                </div>
                <div style="float:left;" class="margin-for-picname col-xl-4 col-md-4">
                <?php echo $picname; ?>
                </div>
                <div style="float:left;" class="margin-for-picname col-xl-4 col-md-4">
                    <button style="padding: 0px 10px;" id="yes-<?php echo $pid; ?>" onclick=approveImage(<?php echo $pid; ?>)>yes</button>
                    <button style="padding: 0px 10px;" id="no-<?php echo $pid; ?>" onclick=deleteImage(<?php echo $pid; ?>)>no</button>
                </div>
            </div>
            <div class="clearfix"></div>
<?php
        }
    }
}
?>