<?php
    // session_start();

    if(isset($_POST['submit'])) {
        $file = $_FILES['file'];
        
        $fileName = $_FILES['file']['name'];
        $fileFullPath = $_FILES['file']['full_path'];
        $fileType = $_FILES['file']['type'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileError = $_FILES['file']['error'];
        $fileSize = $_FILES['file']['size'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if(in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
                if($fileSize < 1000000) { 
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'upload/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    echo "Success";
                    header("Location: index.php?uploadsuccess");
                } else {
                    echo "Your file is too big !";
                }
            } else {
                echo "There was an error uploading your file !";
            }
        } else {
            echo "You cannot upload files of this type !";
        }



    }