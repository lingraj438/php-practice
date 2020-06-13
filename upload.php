<?php
if($_FILES["upload_file"]["name"] != ''){
    $data = explode('.',$_FILES['upload_file']['name']);
    $size = $_FILES['upload_file']['size'];
    $extension = end($data);
    $allowed_extenstion = array('jpg','jpeg','png','pdf');
    if(in_array($extension , $allowed_extenstion))
    {      
        $new_file_name =rand().'.'.$extension;
        $path = $_POST["hidden_folder_name"].'/'.$new_file_name;
            if(move_uploaded_file($_FILES["upload_file"]["tmp_name"],$path))
            {
                echo"Image Uploaded";
            }
            else{
                echo"Error in uploading";
            }
    }
    else{
        echo"Please select a valid file";
    }
}   
else{
    echo"Please Select a file";
}
?>