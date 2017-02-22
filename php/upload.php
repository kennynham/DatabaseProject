<?php
include 'config.php';
include 'mysql.php';

  # if form submission
  if (isset($_POST['submit'])) {
    # if exists a file and there are no errors
    if (isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] == UPLOAD_ERR_OK) {
      # create local  variables form $_POST / sanitize
      foreach ($_POST as $k => $v) { $$k = clean_input($db, $v); }

      # if any spaces exit in the file name
      # replace with underscores
      $file_name = str_replace(' ', '_', clean_input($db, $_FILES['uploaded_file']['name']));

      # move file to images folder
      move_uploaded_file($_FILES["uploaded_file"]["tmp_name"],"./user_images/".$file_name);

      # mysql insert statement
      $sql = "INSERT INTO IMAGES (image_id, user_id, rating, category, description, album, date_uploaded, owner_name, image_name) ". 
        "VALUES(DEFAULT, '".$_SESSION['user']['user_id']."', DEFAULT, '$category','$description','$album',".
        "DEFAULT,'".$_SESSION['user']['firstname']."', '$file_name')";

      #insert into mysql
      if ($result = mysqli_query($db, $sql)) {
        echo "<h2 class=success>Image upload success.</h2>";
      } else {
        # if we have an error, tell them.
        echo "<h2 class=error>Unable to upload image. <br/> Please try again.</h2>";
      }
    } else {
      # if there is an error
       switch ($_FILES['uploadFile']['error']) { 
          case 1:
              print '<p> The file is too big</p>';
              break;
           case 2:
              print '<p> The file is bigger than this form allows</p>';
              break;
           case 3:
              print '<p> Only part of the file was uploaded</p>';
              break;
           case 4:
              print '<p> No file was uploaded</p>';
              break;
        }
    }
                    
  }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ImgRepo</title>
<link rel="stylesheet" type="text/css" href="/css/styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</head>
<body>
<header>
  <img src="/img/logo.png"/>
  <div class="userbox"><i class="fa fa-user" aria-hidden="true"></i>
    <p><?php echo ucfirst($_SESSION['user']['firstname']);?></p>
    <div class="dropdown"><a href="logout.php">Logout</a></div>
  </div>
</header>
<div class="wrapper">
  <div class="forms">
    <div class="gallery_head">
      <h3>Upload Image</h3>
      <a href="search.php"><i class="fa fa-search" aria-hidden="true"></i></a>
      <a href="user.php"><i class="fa fa-home" aria-hidden="true"></i></a>
    </div>
    <div class="gallery_body">
      <form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
        <input id="image" type="file" name="uploaded_file" accept="image/*,.png,.jpg,.jpeg,.bmp">
        <label><input type="text" name="description" placeholder="Description"></label>
        <label><input type="text" name="album" placeholder="Album Name"></label>
        <label>
          <select name="category" required>
              <option value="">Category</option>
              <option value="Animals">Animals</option>
              <option value="Arts and Crafts">Arts and Crafts</option>                          
              <option value="Automobile">Automobile</option>
              <option value="Food">Food</option>
              <option value="Landscape">Landscape</option>
              <option value="Sports">Sports</option>
              <option value="Weapons">Weapons</option>
          </select>
        </label>
        <label><input type="submit" value="upload" name="submit"></label>
      </form>
    </div>
  </div>
</div>
<footer style="position: fixed;bottom: 0;">  
</footer>
</body>