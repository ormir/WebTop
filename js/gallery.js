$(function() {
	var dragging = false;

	// Prevent default for dragging
	$(document).bind('dragover', function (e) {
         e.preventDefault();
    });

 //   	$('#gallery').mouseover(function(){
 //   		$('#drop-info').fadeIn();
 //   		galleryHoover = true;
   		
 // 	});

  //  	$('#gallery').mouseleave(function(){
  //    	$('#drop-info').fadeOut();
  //    	galleryHoover = false;
 	// });

 //   // dragover event listener
	$('#gallery').on('dragenter',function(e){
		e.stopPropagation();
		e.preventDefault();
		dragging = true;
		$('#drop-info').show();
	});

	// $('#gallery').children().on('dragenter',function(e){
	// 	e.stopPropagation();
	// 	e.preventDefault();
	// 	dragging = true;
	// 	// $('#drop-info').show();
	// });

	$('#gallery *').on('dragenter',function(e){
		e.stopPropagation();
		e.preventDefault();
		$('#drop-info').show();
		setTimeout(function () {
			dragging = true;
		}, 1);
		
		// $('#drop-info').show();
	});

	$('#gallery *').on('dragleave',function(e){
		e.stopPropagation();
		e.preventDefault();
		dragging = false;	
	});

	// Leaving from draggable
	$('#drop-info').on('dragleave',function(e){
		e.stopPropagation();
		e.preventDefault();
		setTimeout(function () {
			if (!dragging) $('#drop-info').hide();
		}, 3);
		
	});


	//drop event listener
	// $('#gallery').on('drop',function(e){
	// 	e.preventDefault();
	// 	alert("Hallo");
	// });
});
