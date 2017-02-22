<?php
# This is the code for the user landing screen
# It will grab any images under user_id and display
#
# include config
# 
# routes accessible from here: logout.php upload.php search.php
include 'config.php';

//get id to search for items
$id = $_SESSION['user']['user_id'];

$result = mysqli_query($db, "SELECT * FROM IMAGES WHERE user_id='$id'");

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	# create an array of image_names
	# for output in the div element
	$images[] = $row;
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
	<div class="gallery">
		<div class="gallery_head">
			<h3><?php echo ucfirst($_SESSION['user']['firstname']);?>'s Gallery</h3>
			<a href="search.php"><i class="fa fa-search" aria-hidden="true"></i></a>
			<a href="upload.php"><i class="fa fa-upload" aria-hidden="true"></i></a>
		</div>
		<div class="gallery_body">
		<?php 
		# for each item in images array print the image
		foreach ($images as $k=>$v) {
			$stars = '';
			$rating = (int)$v['rating'];
			for ($x = 0; $x <= $rating; $x++)
				$stars .= '*';

			echo "<div><img src=/user_images/".$v['image_name'].">Rating: <span id=stars>". $stars ."</span><br>Descrption: ".$v['description']."<br>Album: ".$v['album']."</div>";
		}
		?>
		</div>
	</div>
</div>
<footer>	
</footer>
</body>