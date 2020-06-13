$(document).ready(function () {
  load_folder_list();
  function load_folder_list() {
    var action = "fetch";
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { action: action },
      success: function (data) {
        $("#folder_table").html(data);
      },
    });
  }

  // for creating a folder

  $(document).on("click", "#create_folder", function () {
    $("#action").val("Create");
    $("#folder_name").val("");
    $("#folder_button").val("Create");
    $("#old_name").val("");
    $("#change_title").text("Create Folder"); //to chnge title for folder creation or rename from span tag
    $("#folderModal").modal("show"); //to show modal box after clciking
  });

  $(document).on("click", "#folder_button", function () {
    var folder_name = $("#folder_name").val();
    var action = $("#action").val();
    var old_name = $("#old_name").val();

    if (folder_name != "") {
      $.ajax({
        url: "action.php",
        method: "POST",
        data: { folder_name: folder_name, old_name: old_name, action: action },
        //parameters you want to pass in ajax
        success: function (data) {
          $("#folderModal").modal("hide"); //to hide again modal box
          load_folder_list(); //to agin load the list
          alert(data); //TAKE MESSAGE FROM ACTION.PHP SERVER
        },
      });
    } else {
      alert("Enter Folder Name");
    }
  });
  $(document).on("click", ".update", function () {
    // var folder_name = $(this).data("name");      //didn't worked
    var folder_name = this.getAttribute("data-name"); //new code line for taking data-name attribute vaule because it is unique
    $("#folder_name").val(folder_name); //this will place old name in change folder name input
    $("#old_name").val(folder_name);
    $("#action").val("change"); //this will fo in ajax (php) iff statement
    $("#folder_button").val("Update");
    $("#change_title").text("Change Folder Name");
    $("#folderModal").modal("show");
  });
  $(document).on("click", ".upload", function () {
    // var folder_name = $(this).data("name");      //didn't worked
    var folder_name = this.getAttribute("data-name"); //new code line for taking data-name attribute vaule because it is unique
    $("#hidden_folder_name").val(folder_name);
    $("#uploadModal").modal("show");
  });
  $("#upload_form").on("submit", function () {
    var form_data = new FormData(this); //becarefull for this important one
    $.ajax({
      url: "upload.php",
      method: "POST",
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        load_folder_list();
        alert(data);
        $("#uploadModal").modal("hide"); //to hide again modal box
        document.getElementById("file_data").value = null;
      },
    });
    return false;
  });
  $(document).on("click", ".view_files", function () {
    // var folder_name = $(this).data("name");      //didn't worked
    var folder_name = this.getAttribute("data-name");
    //new code line for taking data-name attribute vaule because it is unique
    var action = "fetch_files";
    $.ajax({
      url: "action.php",
      method: "POST",
      data: { action: action, folder_name: folder_name },
      success: function (data) {
        $("#file_list").html(data);
        $("#filelistModal").modal("show");
      },
    });
  });
  $(document).on("click", ".remove_file", function () {
    var file = this.getAttribute("id");
    var name = file.split("/");
    length = name.length;
    $file_name = name[length - 1];
    var action = "remove_file";
    if (confirm("Do you really want to remove " + $file_name)) {
      $.ajax({
        url: "action.php",
        method: "POST",
        data: { action: action, path: file },
        success: function (data) {
          alert(data);
          $("#filelistModal").modal("hide");
          load_folder_list();
        },
      });
    } else {
      return false;
    }
  });
  $(document).on("click", ".delete", function () {
    var file = this.getAttribute("data-name");
    var action = "remove_folder";
    if (confirm("Do you really want to remove folder " + file)) {
      $.ajax({
        url: "action.php",
        method: "POST",
        data: { action: action, path: file },
        success: function (data) {
          load_folder_list();
          alert(data);
        },
      });
    } else {
      return false;
    }
  });
  $(document).on("click", ".update_file", function () {
    var new_file_name = $("#input_name").val();
    var pathandfile = this.getAttribute("data-name");
    var arr = pathandfile.split(",");
    var folder_path = arr[0];
    var old_file_name = arr[1];
    var action = "update_file_name";
    if (new_file_name == "") {
      alert("please fill the name field to update");
    } else {
      $.ajax({
        url: "action.php",
        method: "POST",
        data: {
          action: action,
          new_file: new_file_name,
          path: folder_path,
          old_file_name: old_file_name,
        },
        success: function (data) {
          alert(data);
        },
      });
    }
  });
});
