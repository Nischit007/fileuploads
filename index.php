<?php 
    if(isset($_POST['submitbtn'])){
       $err = [];
       // checking the error
       if(isset($_FILES['filename']['error']) && $_FILES['filename']['error']==0){

        if($_FILES['filename']['size'] < 5000000){
            $types = ['image/jpg', 'image/png', 'image/jpeg', 'image/gif', 'application/pdf'];

            if(in_array($_FILES['filename']['type'], $types)){
                if(move_uploaded_file($_FILES['filename']['tmp_name'], 
                'photos/'.$_FILES['filename']['name'])){

                    echo "File Successfully uploaded!";
                } else {
                    echo "Failed to upload file!";
                }
            } else {
                $err['fileErr'] = "Unsupported File Type!";
            }
        } else {
            $err['fileErr'] = "Size must not exceed 4 MB";
        }
       } else {
        $err['fileErr'] = "Something went wrong!";
       }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Uploads</title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="file" name="filename">
        <?php 
            if(isset($err['fileErr'])){
                echo $err['fileErr'];
            }
        ?>
        <input type="submit" name="submitbtn" />
    </form>
</body>
</html>