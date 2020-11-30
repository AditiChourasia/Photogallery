
  <div class="col-xl-3 col-lg-3 col-md-8">
                <div class="user-uploaded-pics" id="user-uploaded-pics">
                    <?php get_user_uploaded_pics($session); ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="row row-back">
                    <h2 class="margin-left bold margin-bottom">Avatar</h2><br>
                    <div style="margin-top: 1.8cm; margin-left:-2.5cm; margin-bottom: 0.2cm;"><?php get_avatar_image($session) ?><br></div>
                    <div class="upload-avatar" name="av-upload" id="av-upload">
                        <input type="file" name="user-av-upload" id="user-av-upload"></div>
                    <div class="profile-information margin-bottom">
                        <h2 class="margin-left1 bold">Profile Info</h2>
                        <div style="margin-top: 0.3cm; margin-left: -0.3cm;"><?php get_profile_info($session); ?></div>
                        <p><a href="update.php" class="margin-left login-link">Update Profile</a></p>
                    </div>
                    <div class="upload-image">
                        <h2 class="margin-left1 bold">Upload New Image</h2>
                        <form style="margin-left: -0.5cm" method="post" enctype="multipart/form-data" name = "upload-image ">
                            <input type="file" name="new-image" id="new-image">
                        </form>
                    </div>
                </div>
            </div>