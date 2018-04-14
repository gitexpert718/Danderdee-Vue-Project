<?php
// $message = '';
// if(isset($_POST['location']))
// {
//     if($_FILES["image"]["name"] != '' && isset($_FILES["image"]["tmp_name"]) && $_FILES["image"]["tmp_name"])
//         {
//             $target_dir = $_POST['location'];
//            // $imageFileType = pathinfo(basename($_FILES["image"]["name"]),PATHINFO_EXTENSION);
//            // $randName = date("YdmiHs") . '_000_' . rand(1000000000,9999999999) . '.' . $imageFileType;
//             $target_file = $target_dir . basename($_FILES["image"]["name"]);
//             $uploadOk = 1;
//
//             // Check if image file is a actual image or fake image
//
// //            $check = getimagesize($_FILES["image"]["tmp_name"]);
// //            if($check !== false) {
// //                $uploadOk = 1;
// //            } else {
// //                $message.=  "File is not an image.";
// //                $uploadOk = 0;
// //            }
//
//             // Check if file already exists
// //            if (file_exists($target_file)) {
// //                $message.=  "Sorry, file already exists.";
// //                $uploadOk = 0;
// //            }
// //            // Check file size
// //            if ($_FILES["image"]["size"] > 5000000000000000) {
// //                $message.=  "Sorry, your file is too large.";
// //                $uploadOk = 0;
// //            }
//             // Allow certain file formats
// //            if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg"
// //            && $imageFileType != "gif" ) {
// //                $message.=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
// //                $uploadOk = 0;
// //            }
// //            // Check if $uploadOk is set to 0 by an error
// //            if ($uploadOk == 0) {
// //                $message.=  "Sorry, your file was not uploaded.";
// //            // if everything is ok, try to upload file
// //            }
//             if($uploadOk == 1)
//             {
//                 if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
//                     $message.= " Image uploaded Successfully <br/>";
//                 }
//                 else
//                 {
//                     $message.= " Unable to upload image <br/>";
//                 }
//             }
//         }
//         else
//         {
//             $message.= "No image";
//         }
// }

?>

<?php include('includes/header.php');
include('includes/sidebar.php');
?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <?php include('includes/nav-header.php'); ?>

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Uploads
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

          </ol>
        </section>
        <section class='content ' id="myApp" ng-app="myApp" ng-controller="myCtrl">
            <?php echo $message ?>
            <div class="row">
                <div class="col-xs-12 ">
                  <!-- general form elements -->
                    <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">UPLOADS</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="image" class="form-control"/>
                        <input type="text" name="location" placeholder="location" class="form-control" />
                        <button class="btn btn-success" type="submit">UPLOAD</button>
                    </form>
                </div><!-- /.box-body -->

              </div><!-- /.box -->
            </div>
            </div>

        </section>

</div>

<?php include('includes/footer.php'); ?>
