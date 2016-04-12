<div id='gallery'>
	<div id='gallery-image-upload'></div>
	<div id='gallery-images'>
		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi hendrerit vel lectus non accumsan. In mauris lacus, congue quis  vel, dapibus iaculis libero. Sed lacus felis, gravida sit amet mi vel, hendrerit consectetur diam. Sed sed pellentesque nisl. Etiam tempus mi massa, vulputate fermentum lorem posuere at. Etiam accumsan tempor nibh ac placerat. In congue ligula quis sem ornare convallis. Etiam maximus est sit amet dolor convallis, eu vehicula nulla cursus. Integer eget dolor ut ante egestas luctus sit amet quis neque. Cras at tempor dolor. Suspendisse at aliquet magna, id suscipit risus. Mauris id volutpat lacus.
	</div>
	<div id="drop-info">
		<p>DROP</p>
	</div>
</div>

<!-- Function to display and delete all images -->

<?php 
$resource = opendir("upload"); //if the folder in our htdocs is called "upload"
while (($entry = readdir($resource)) !== FALSE){
	if($entry != '.' && $entry != '..'){
		echo "<img src='upload/$entry'>"; 
		$file_name.= $entry.'<br>';
	}
}
echo '<br>'.$file_name; //file name of the image is shown beneath the image
	

if(isset($_POST['delete_img'])){		//delete_img is the name of the button to delete the images
	$img_file = $_POST['filename'];
	if($img_file){
		unlink("./upload/$img_file");
		header("Refresh:0");
	}
} 