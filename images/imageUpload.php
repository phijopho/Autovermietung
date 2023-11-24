<!DOCTYPE HTML>
<html>

<body>
    <!-- image upload form -->
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <label>Select Image File:</label>
        <input type="file" name="image">
        <!-- type "file" => show as file select button; store file in global variable $_FILES -->
        <input type="submit" name="submitUploadImage" value="Upload">
    </form>

    <?php
    $status = $statusMsg = '';

    // If file-upload-form is submitted:
    if (isset($_POST["submitUploadImage"])) {
        // Include the database configuration file
        require_once('../includes/dbConnection.php');

        $status = 'error';

        if (!empty($_FILES["image"]["name"])) {
            $fileName=basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'svg');
            if(in_array($fileType, $allowTypes)){
                $image=$_FILES['image']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));
                echo $fileName;
                try {
                    $insert = $conn->exec("UPDATE CarType SET Image='$imgContent' WHERE Img_File_Name='$fileName'");
                    if($insert){
                        $status = 'success';
                        $statusMsg = 'File uploaded successfully.';
                    }else{ 
                        $statusMsg = 'File upload failed, please try again.'; 
                    }    
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }
            }else{ 
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, SVG & GIF files are allowed to upload.'; 
            }
        }else{ 
            $statusMsg = 'Please select an image file to upload.'; 
        }
        echo $statusMsg;
    }
    ?>
</body>
</html>