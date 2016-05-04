<div id='gallery'>
	<div id='gallery-image-upload'></div>
	<form action="./includes/upload.php" method="post" id="myForm" enctype="multipart/form-data">
			<input type="file" name="file" id="file">
			<input type="submit" name="submit" value="Upload Image">
	</form>

	<div id='gallery-images'>
		<?php 
			$resource = opendir("upload"); //if the folder in our htdocs is called "upload"
			while (($entry = readdir($resource)) !== FALSE){
				if($entry != '.' && $entry != '..' && $entry != '.DS_Store'){

					echo "<div class='gallery-thumbnail'>".
						"<img class='thumbnail-close' src='images/delete.png'>".
						"<a class='fancybox' rel='group' href='upload/$entry'>".
						"<img class='thumbnail-content' src='upload/$entry' alt='' />".
						"</a></div>"; 
				}
			}
		?>
	</div>
	<div id="drop-info">
		<p>DROP</p>
	</div>
</div>