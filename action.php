<?php
function format_folder_size($size){
    if($size >= 1073741824){
        $size = number_format($size / 1073741824, 2).'GB';
    }
    elseif($size >= 1048576){
        $size = number_format($size / 1048576, 2).'MB';
    }
    elseif($size >= 1024){
        $size = number_format($size / 1024, 2).'KB';
    }
    else if($size > 1){
        $size = $size.'Bytes';
    }
    else if($size == 1){
        $size = $size.'byte';
    }
    else{
        $size = '0 byte';
    }
    return $size;
}
function get_folder_size($folder_name){
    $total_size =0;
    $files = scandir($folder_name);
    foreach($files as $file){
        if($file === '.' OR $file === '..'){
            continue;
        }
        else{
            $path = $folder_name.'/'.$file;
            $total_size = $total_size + filesize($path);
        }
    }   
    return format_folder_size($total_size);
}

if(isset($_POST["action"]))
{
    if($_POST["action"] =="fetch"){
        $folder = array_filter(glob('*'),'is_dir');
        $output = '
        <table class="table table-borderless table-striped">
        <tr>
            <th>Folder</th>
            <th>TotalFile</th>
            <th>TotalSize</th>
            <th>Update</th>
            <th>Delete</th>
            <th>upload</th>
            <th>View files</th>
        </tr>
        ';
        if(count($folder) >0 ){
            foreach($folder as $name){
                $output .= '
                <tr>
                <td>'.$name.'</td>
                <td>'.(count(scandir($name)) -2 ).'</td>
                <td>'.get_folder_size($name).'</td>
                <td><button type="button" name="update" data-name="'.$name.'" class="update btn btn-warning btn-xs">Update</button></td>
                <td><button type="button" name="delete" data-name="'.$name.'" class="delete btn btn-danger btn-xs">Delete</button></td>
                <td><button type="button" name="upload" data-name="'.$name.'" class="upload btn btn-info btn-xs">Upload</button></td>
                <td><button type="button" name="view_files" data-name="'.$name.'" class="view_files  btn btn-default btn-xs">View Files</button></td>
                </tr>
                ';
            }
        }
        else{
            $output .= '
            <tr>
                <td colspan="7">No Folder Found</td>
            </tr>
            ';
        }
        $output .= '</table>';
        echo $output;
    }
    //  above code is for table of datas

    // for create folder button
    if($_POST["action"] == "Create"){
        if(!file_exists($_POST["folder_name"])){  // folder existence chceking
            mkdir($_POST["folder_name"], 0777, true);            
            echo"Folder Created"; //message from server
        }
        else{
            echo"Folder Already Exist";     //message from server
        }
    }
    if($_POST["action"] == "change"){
        if(!file_exists($_POST["folder_name"])){  // folder existence chceking
            rename($_POST["old_name"],$_POST["folder_name"]); //renmaing the folder
            echo"Folder Updated"; //message from server
        }
        else{
            echo"Folder Already Exist";     //message from server
        }
    }
    if($_POST["action"] == "fetch_files"){
        $file_data = scandir($_POST["folder_name"]);
        $output = '
        <table class="table table-bordered table-striped">
        <tr>
            <th>Image</th>
            <th colspan="2">File Name</th>
            <th>Delete</th>
        </tr>
        ';
        foreach($file_data as $file){
            if($file == '.' OR $file == ".." ){
                continue;
            }
            else{
                $pathandfile =$_POST["folder_name"].','.$file;
                $path = $_POST["folder_name"].'/'.$file;
                $name = explode(".",$file);
                $file_name = $name[0];
                $output .= '
                <tr>
                <td><img src="'.$path.'" class="img-thumbnail" height="50" width="50" /></td>
                <td><input id="input_name"type="text" value="'.$file_name.'" style="border:0px;width:100%;"></td>
                <td><button name="update_file" class="update_file btn btn-success btn-xs" data-name="'.$pathandfile.'">
                Update</button></>
                <td><button name="remove_file" class="remove_file btn btn-danger btn-xs" id="'.$path.'">
                Remove</button></>
                </tr>
                ';
            }
        }
        $output .= '</table>';
        echo $output;
    }
    //to remove files
    if($_POST["action"] == "remove_file"){
        $file = $_POST["path"];
        if(file_exists($file)){  // confirmation
            unlink($file);
            echo "file is removed";
        }
    }
    if($_POST["action"] == "remove_folder"){
        $folder = $_POST["path"];
        $files = scandir($folder);
        foreach($files as $file){
            if($file === '.' OR $file === '..' ){
                continue;
            }
            else{
                unlink($folder.'/'.$file);
            }
        }
        if(rmdir($folder)){
            echo "Folder is deleted";
        }
    }
    if($_POST["action"] == "update_file_name"){
        $extr = explode(".",$_POST["old_file_name"]);
        $ext = end($extr);
        $old_path = $_POST["path"].'/'.$_POST["old_file_name"];
        $new_path = $_POST["path"].'/'.$_POST["new_file"].'.'.$ext;
        $name = explode(".",$_POST["old_file_name"]);
        $old_file_name = $name[0];
        if($old_file_name === $_POST["new_file"]){
            echo "please update the name first";
        }
        else{
            rename($old_path,$new_path);
            echo "file is updated as ".$_POST["new_file"].'.'.$ext;
        }   
    }
}
?>
