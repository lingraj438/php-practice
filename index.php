<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="index.js"></script>
    <script></script>
    <title>Document</title>
  </head>
  <body id="bo">
    <div class="box center">
      <h2>Green Library Books</h2>
      <div class="contents">
        <div class="tank">
          <div id="folder_table" class="table-responsive"></div>
        </div>
        <div class="uploader">
          <button type="button" name="create_folder" id="create_folder" class="btn btn-success">Create Folder</button>
        </div>
      </div>
    </div>
  </body>
</html>

<div id="folderModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title"><span id="change_title">Create Folder</span></h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button><br>        
      </div>
      <div class="modal-body">
        <p>Enter Folder Name
        <input type="text" name="folder_name" id="folder_name" class="form-control" />
      </p>
      <br />
      <input type="hidden" name="action" id="action" />
      <input type="hidden" name="old_name" id="old_name" />
      <input type="button" name="folder_button" id="folder_button" class="btn btn-info" value="Create" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-deafult" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title"><span id="change_title">Upload Your File</span></h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button><br>        
      </div>
      <div class="modal-body">
        <form method="post" id="upload_form" enctype='multipart/form-data'>
        <p>Select Your file
        <input type="file" name="upload_file" id="file_data"/></p>
        <br />
        <input type="hidden" name="hidden_folder_name" id="hidden_folder_name" />
        <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-deafult" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="filelistModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">
      <span id="change_title">File List</span></h4>  
      <button type="button" class="close" data-dismiss="modal">&times;</button><br>        
      </div>
      <div class="modal-body" id="file_list">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-deafult" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>