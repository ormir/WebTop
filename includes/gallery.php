<div id='gallery'>
	<div id='gallery-image-upload'></div>
	<!-- <form method="post" action="./includes/upload.php" enctype="multipart/form-data">
		<input type="file" name="filename" />
		<input type="submit" name="submit"/>
	</form> -->

	<form action="./includes/upload.php" method="post" id="myForm" enctype="multipart/form-data">
			<input type="file" name="file" id="file">
			<input type="submit" name="submit" value="Upload Image">
	</form>

	<div id='gallery-images'>
		<?php 
			$resource = opendir("upload"); //if the folder in our htdocs is called "upload"
			while (($entry = readdir($resource)) !== FALSE){
				if($entry != '.' && $entry != '..'){
					echo "<img src='upload/$entry'>"; 
					// $file_name.= $entry.'<br>';
				}
			}
		?>
	</div>
	<div id="drop-info">
		<p>DROP</p>
	</div>
</div>

<!-- Function to display and delete all images -->
<?php 
// $resource = opendir("upload"); //if the folder in our htdocs is called "upload"
// while (($entry = readdir($resource)) !== FALSE){
// 	if($entry != '.' && $entry != '..'){
// 		echo "<img src='upload/$entry'>"; 
// 		// $file_name.= $entry.'<br>';
// 	}
// }
// echo '<br>'.$file_name; //file name of the image is shown beneath the image
	

// if(isset($_POST['delete_img'])){		//delete_img is the name of the button to delete the images
// 	$img_file = $_POST['filename'];
// 	if($img_file){
// 		unlink("./upload/$img_file");
// 		header("Refresh:0");
// 	}
// } 
?>