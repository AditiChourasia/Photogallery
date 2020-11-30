
 $(document).ready(function() {
     $(".type").textrotator({
         animation: "dissolve", // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
         separator: ",", // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
         speed: 1000 // How many milliseconds until the next word show.
     });
     $(window).scroll(function () {
         var top = $(window).scrollTop();
         if (top >= 100) {
             $("header").addClass('transparent-bg');
         } else {
             if ($("header").hasClass('transparent-bg')) {
                 $("header").removeClass('transparent-bg');
             }
         }
     });

     $('#user-av-upload').on("change", function () {
         var avatarfile = $(this)[0].files[0];
         var type = avatarfile.type;
         var type1 = type.substring(type.indexOf("/") + 1);
         var size = avatarfile.size;
         if (type1 != "jpg" && type1 != "jpeg" && type1 != "png") {
             alert("file type is not supported");
         } else if (size > 5000000) {
             alert("file size should be less than 5mb");
         } else {
             var formdata = new FormData();
             formdata.append('avatar', avatarfile);
             xhr = new XMLHttpRequest();
             xhr.addEventListener('load', avatarloadedhandler, false);
             xhr.open('POST', 'avatarchange.php',  true);
             xhr.send(formdata);

             function avatarloadedhandler(evt) {
                 $('#avatar-id').attr("src", evt.target.responseText);
             }
         }
     });
     $('#new-image').on("change", function () {
         var file = $(this)[0].files[0];
         var type = file.type;
         var type1 = type.substring(type.indexOf("/") + 1);
         var size = file.size;
         if (type1 != "jpg" && type1 != "jpeg" && type1 != "png") {
             alert("file type is not supported");
         } else if (size > 5000000) {
             alert("file size should be less than 5mb");
         } else {
             var formdata = new FormData();
             formdata.append('new-file', file);
             xhr = new XMLHttpRequest();
             xhr.addEventListener('load', loadedhandler, false);
             xhr.open('POST', 'img-upload.php',  true);
             xhr.send(formdata);

             function loadedhandler(evt) {
                 var response = evt.target.responseText;
                 $('#user-uploaded-pics').prepend("<div style=\"float: left\" class='gallery'><img class=\"gallery-img\" src=\'"+response+"\'></div>");
             }
         }
     });
 });
function approveImage(id) {
    var rowid = "row-"+id;
    $.ajax({
        url:'approve.php',
        data: {id:id},
        type: 'post',
        success: function (result) {
            $("#"+rowid).hide(1000);
           }
    })

}
function deleteImage(id) {
     var rowid = "row-"+id;
     $.ajax({
         url:'delete.php',
         data: {id:id},
         type: 'post',
         success: function (result) {
             $("#"+rowid).hide(1000);
         }
     })

 }
