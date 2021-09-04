<?php
    $msg ="";
    //if uplaod buton is pressed
    if (isset($_POST['upload'])) {
        //path to store uploaded image / move_uploaded_file here
        $target ='images/'.basename($_FILES['image']['name']);

        //connect to db 
        $db = mysqli_connect('localhost', 'root', '' , 'photos');
        
        //get all submitted data from the form 
        $images = $_FILES['image']['name'];
        $text = $_POST['text'];

        // echo "<pre>";
        //  print_r($_FILES);
        // echo "<pre>";

        $sql ="INSERT INTO images (images, text) VALUES ('$images' , '$text' )";
        mysqli_query($db, $sql); //stores the submitted data into db table : images

        //Now let's Move the Uploaded image into folder: images
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image Uploaded Succesfully";
        }else {
            $msg = "There was a Problem Loading Image";
        }
        echo $msg;
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            File Upload
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div id="content">
            <?php 
                $db = mysqli_connect('localhost', 'root', '' , 'photos');
                $sql = "SELECT * FROM images";
                $result = mysqli_query($db, $sql);
                while ($row = mysqli_fetch_array($result)){

                    // echo"<pre>";
                    // print_r($row);
                    // echo"</pre>";

                    echo "<div id='img_div'>";
                        echo "<img src='images/".$row['images']."'>";
                        echo "<p>".$row['text']. "</p>";
                    echo "</div>";
                }

            ?>


            <form method="post" action="index.php" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <div>
                    <input type="file" name="image">
                </div> 
                <div>
                    <textarea name="text" cols="40" rows="4" placeholder="say something about this image..">
                    </textarea>
                </div>
                <div>
                    <input type="submit" name="upload" value="Upload Image">
                </div>

            </form>
        </div>
        
        <script src="" async defer></script>
    </body>
</html>
