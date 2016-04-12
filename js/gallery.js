$(function() {
	var dragging = false;
	
	// Prevent default for dragging
	$(document).bind('dragover', function (e) {
         e.preventDefault();
    });


    $('#gallery')
	  .on('dragbetterenter', function() {
	  	$('#drop-info').show();
	  })
	  .on('dragbetterleave', function() {
	  	$('#drop-info').hide();
	  })


	//drop event listener
	$('#gallery').on('drop',function(e){
		e.stopPropagation();
		e.preventDefault();
		// alert("upload");

		// Hide "Drop" hint
		$('#drop-info').hide();
		
		//capture the files
		var files = e.originalEvent.dataTransfer.files;
		var file =files[0];
		//console.log(file);

		//upload the file using xhr object
		upload(file);

	});

	// Delete image from gallery
	$('.thumbnail-close').click(function() {
		$(this).parent().fadeOut();
		deleteGalleryImage($(this).siblings());
	});

});

function deleteGalleryImage(image) {
	$.ajax({
		url: 'ajax/delete_gallery_image.php',
		type: 'post',
		data: {path: image.attr('src')}
	});
}

function upload(file){

	//create xhr object
	xhr = new XMLHttpRequest();

	//check if the uploading file is image
	if(xhr.upload && check(file.type))
	{
	//initiate request
	xhr.open('post','includes/drop_upload.php',true);

	//set headers
	xhr.setRequestHeader('Content-Type',"multipart/form-data");
	xhr.setRequestHeader('X-File-Name',file.fileName);
	xhr.setRequestHeader('X-File-Size',file.fileSize);
	xhr.setRequestHeader('X-File-Type',file.fileType);

	//send the file
	xhr.send(file);

	//event listener
	xhr.upload.addEventListener("progress",function(e){
		var progress= (e.loaded/e.total)*100;
		$('.progress').show();
		$('.progress-bar').css('width',progress+"%");
	},false);

	//upload complete check
	xhr.onreadystatechange = function (e){
		if(xhr.readyState ===4)
		{
			if(xhr.status==200)
			{
				$('.progress').hide();
				$("#gallery-images").html("<div class='gallery-thumbnail'>"+
						"<img class='thumbnail-close' src='images/delete.png'>"+
						"<img src='"+xhr.responseText+"' width='100%'/></div>");
			}
		}
	}
	}
	else
		alert("please upload only images");
}

//function to check the image type
function check(image){
	switch(image){
		case 'image/jpeg':
		return 1;
		case 'image/png':
		return 1;
		case 'image/gif':
		return 1;
		default:
		return 0;
	}
}
