<?php
include 'config.php';

//collect
if(isset($_POST['search']))
{
	$searchq = $_POST['search'];
	
	$query = mysql_query("SELECT * FROM IMAGES WHERE description LIKE '%$searchq%' 
							OR category LIKE '%$searchq%'
							OR album LIKE '%$searchq%'") or die('Could not search');
	$count = mysql_num_rows($query);
	if ($count == 0)
	{
		$output = 'There was no search results';
	}
	else
	{
		while ($row = mysql_fetch_array($query))
		{
			# create an array of image_names
			# for output in the div element
			$images[] = $row['image_name'];	

			# for debug and inspecting items grabbed.
			#var_export($images);exit; #this halts the page load
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
      <h3>Search Image</h3>
      <a href="search.php"><i class="fa fa-search" aria-hidden="true"></i></a>
      <a href="user.php"><i class="fa fa-home" aria-hidden="true"></i></a>
    </div>
    <div class="gallery_body">
      <form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
       
        <label><input type="submit" value="upload" name="submit"></label>
      </form>
    </div>
  </div>
</div>
<footer style="position: fixed;bottom: 0;">  
</footer>
</body>