<?php
    require_once("database.php");
    session_start();
    //This page is only accessible if you're logged in
    if (!isset($_SESSION['id'])){
        header("location:/register/login.php");
    }
    //When the upload button is clicked the image is uploaded into the uploads file. Only jpg, png and gif extensions are accepted.
    $alert = "";
    if (isset($_POST['upload'])){
        $file = $_FILES['image'];
        $extensions = array('jpg', 'jpeg', 'gif', 'png');
        $file_text = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($file_text));
        //if the file does not have the specified extensions "Format not accepted"
        if (!in_array($file_ext, $extensions)){
            $alert = "<h5>Format not accepted: Please upload<br>jpg, jpeg, png or gif</h5>";
        }
        //if an error has occured
        elseif($_FILES['image']['error']){
            $alert = "An error occured";
        }
        //create a random name for the image to prevent image overwriting. Upload image to folder and insert image name into the database.
        else {
            $fileNameNew = uniqid('',true).".".$file_ext;
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$fileNameNew);
            $alert = "<h5>File Uploaded successfully</h5>";
            $sql = "INSERT INTO image (img,article_likes) VALUES ('\"uploads/\".$fileNameNew', 0)";
	        $connection->exec($sql);
        }
    }
?>
<!doctype html>
<html>
    <head>
        <title>Camagru</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-default navbar-expand-lg">
            <div class="navbar-header">
                <a class="navbar-brand" href="Gallery.php" style="margin:16px 5px">Camagru</a>
            </div>
            <div style="position:absolute; right:5%;">
                <a class="navbar-nav" href="Gallery.php" style="margin:23px 5px">Gallery</a>
                <a class="navbar-nav" href="admin.php" style="margin:23px 5px">Change credentials</a>
                <a class="navbar-nav" href="register/logout.php" style="margin:23px 5px">Logout <?php echo $_SESSION['id']?></a>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- Live video image-->
                    <video id="video" autoplay></video>
                    <p>
                        <!-- When snap button is clicked it takes a snapshot of the video-->
                        <button id="snap" class="btn btn-default">Take Snapshot</button>
                        <!-- When button is clicked the uploadEx function is called which takes the snapshot and uploads it to the uploads file-->
                        <button onclick="uploadEx()" id="new" class="btn btn-default">Save and Upload</button>
                        <form method="post" accept-charset="utf-8" name="form1">
                            <input name="hidden_data" id="hidden_data" type="hidden">
                        </form>
                        <!-- superposable image on top of the canvas -->
                        <img src="">
                        <!-- Screenshot image is stored in canvas -->
                        <canvas id="canvas" style="display:none"></canvas>
                    </p>
                <img id="test" onclick="change()">
                </div>
                <!-- Uploading images from your computer if you don't have a webcam -->
                <div class="col-md-4">
                    <form class="form-group" method="post" action="capture_upload.php" enctype="multipart/form-data">
                        <input type="hidden" name="size" value="10000000">
                        <div>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div>
                            <input type="submit" name="upload" value="upload image">
                        </div>
                    </form>
                    <?php echo $alert ?>
                    <!-- Selection of superposable image -->
                    <!-- Options to select an image that is used on top of your webcam image. I've used an extremely tiny gif for the
                    the default image(handtinywhite.gif). When you select an option (onchange) the image source will change to option you
                    have selected which will change the below img as well as add the src to your second canvas image below.
                    -->
                    <img class="img1" height="200" width="300" src="">
                    <select id="dropdown" onchange="setPicture(this)">
                   
                        <option value="Test_images/enjoy.gif">None</option>
                        <option value="Test_images/arnold.png">Arnold</option>
                        <option value="Test_images/camel.png">Camel</option>
                        <option value="Test_images/croc.png">Crocodile</option>
                        <option value="Test_images/eagle.png">Eagle</option>
                        <option value="Test_images/wendigo.png">China</option>
                        <option value="Test_images/monkey.png">Monkey</option>
                        <option value="Test_images/plastic.png">Monkey</option>
                        <option value="Test_images/tengu.png">Tengu</option>
                    </select>
                </div>
            </div>
            <div class="row">
            <?php
            //Select all images that the user captured. Display it under the canvas as thumbnails.
                $getComments = $connection->prepare("SELECT * FROM image");
                    $getComments->execute();
                    $users = $getComments->fetchAll();
                    foreach ($users as $user){
                        if ($user['user'] == $_SESSION['id'])
                        {
                            echo '<img style="inline:block; margin:43px auto 0px auto;" class="img-thumbnail center-block col-sm-12 col-md-6 col-lg-3" src="'.$user['img'].'" alt="Image"/>';
                        }
                    }
            ?>
            <div>
        </div>
        <script>
                /*Object is used when calling getUserMedia() to specify what kinds of tracks is needed with the video stream. 
                Optionally, to add constraints such as video and audio. */
                const constraints = {
                    video:true,
                    audio:false
                }
                const video = document.querySelector("#video");
                //getUserMedia method prompts the user for permission to use a media input which produces, in this case, a video stream.
                navigator.mediaDevices.getUserMedia(constraints).then((stream) => {video.srcObject = stream});
                const screenShotButton = document.querySelector('#snap');
                const img = document.querySelector("img");
                const img1 = document.querySelector('.img1');
                
                //this function is called above with the selection of superposable images. Depending on which option you selected it takes the value and adds it to the image src.
                function setPicture(select){
                    var DD = document.getElementById('dropdown');
                    var value = DD.options[DD.selectedIndex].value;
                    img1.src = value;

                }
                //when the screenshot button is clicked a canvas image is created from the video feed and img1 is added on the top
                screenShotButton.onclick = video.onclick = function(){
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    var context = canvas.getContext('2d');

                    context.globalAlpha = 1.0;
                    context.drawImage(video, 0, 0);
                    context.globalAlpha = 1.0;
                    context.drawImage(img1, 59, 92);
                    // toDataUrl method returns a data URI containing a representation of the image in the format specified by the type. 
                    //In this case the format is png
                    img.src = canvas.toDataURL('image/png');
                };
                function handleSuccess(stream) {
                    screenShotButton.disabled = false;
                    video.srcObject = stream;
                }
                var url = canvas.toDataURL();

                //Function uses ajax to send image data to upload_data.php
                function uploadEx(){
                    var dataURL = canvas.toDataURL("image/png");
                    document.getElementById('hidden_data').value = dataURL;
                    var fd = new FormData(document.forms["form1"]);

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'upload.php', true);

                    xhr.upload.onprogress = function(e){
                        if (e.lengthComputable) {
                            var percentComplete = (e.loaded /e.total) * 100;
                            console.log(percentComplete + '% uploaded');
                            alert('Succesfully uploaded');
                        }
                    };
                    xhr.send(fd);

                }
        </script>
    </body>
</html>