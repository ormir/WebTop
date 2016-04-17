$(function() {
	restoreSavedPositions();
	
    $('.draggable').draggable({
    	scroll: false,
    	stop: function (event, ui) {
    		saveElementPosition(ui.helper.attr('id'), ui.position.top, ui.position.left);
    	}
    });

    $('.img-close').click(function (event) {
    	// $(this).parent().hide();
    	$(this).parent().fadeOut();
    	deleteElementPosition($(this).parent().attr('id'));
    });

    $('#taskleiste-icon').click(function(event) {
    	$('#taskmenu').toggle();
    });

    $('#login-icon')
	    .hover(
	    	function(eventIn) {
		    	$(this).attr('src', 'images/register.png');
	    	},
	    	function (eventOut) {
	    		$(this).attr('src', 'images/logo.png');
	    	}
	    )
	    .click(function(event) {
	    	$('<form method="post" action="index.php"><input name="register"></form>').submit();
	    });

	$('#register-icon')
	    .hover(
	    	function(eventIn) {
		    	$(this).attr('src', 'images/logo.png');
	    	},
	    	function (eventOut) {
	    		$(this).attr('src', 'images/register.png');
	    	}
	    )
	    .click(function(event) {
	    	location.reload();
	    });

	$('.profile_edit') .click(
		function(event){
			$(this).hide();
			mSybling = $(this).siblings('input');
			mSybling.show();
			mSybling.attr('value', $(this).html());

			// Show edit buttons
			$('.profile-editing').show();
		}
	);

	$('#profile-cancel').click(function(event) {
		$(this).siblings().find('.profile_edit').show();
		// TODO Clear input value on cancel
		$(this).siblings().find('input').hide();
		$(this).siblings('button').hide();
		$(this).hide();
	});

	// Save profile changes
	$('#profile-save').click(function(event){
		var inputarr = $(this).siblings().find('input');
		var changesObj = {};

		// Get changed values
		$.each(inputarr, function(index, element) {
			var inputVal = $(element).val();
			if (inputVal != "") {
				changesObj[$(element).attr('data-type')] = inputVal;

				$(element).siblings('.profile_edit').html(inputVal);
				$(element).siblings('.profile_edit').show();
				$(element).hide();
			}


		});

		// Send changed values
		$.ajax({
			url: 'ajax/edit_profile.php',
			type: 'post',
			data: {"changes": changesObj},
			success: function (responce) {
				if (responce.success == 1){
					// Show saved values
				}
			}

		});

		$(this).siblings('button').hide();
		$(this).hide();
	});


});



/**
 * Show window and save its state
 * @param  {string} windowID ID of window to be shown and saved
 */
function openWindow(windowID) {
	$(windowID).fadeIn();
	saveElementPosition($(windowID).attr('id'), $(windowID).position().top, $(windowID).position().left);
}

/**
 * Save elemet position in SESSION
 * @param  {string} elmemetId   id of the element
 * @param  {int} elementTop  top position of the element
 * @param  {int} elementLeft left position of the element
 * @return {null}
 */
function saveElementPosition(elmemetId, elementTop, elementLeft) {
	$.ajax({
		url: 'ajax/save_position.php',
		type: 'post',
		data: {element: {id: elmemetId, top: elementTop, left: elementLeft}},
	});
}

/**
 * Remove elemet position from SESSION
 * @param  {string} myElmemetId id of element to be removed
 * @return {null}
 */
function deleteElementPosition(myElmemetId) {
	$.ajax({
		url: 'ajax/delete_position.php',
		type: 'post',
		data: {elementid: myElmemetId},
	});
}

/**
 * Restore all elements save on SESSION
 * @return {null}
 */
function restoreSavedPositions() {
	$.ajax({
		url: 'ajax/all_position.php',
		type: 'post',
	})
	.done(function(elementList) {
		// console.log(elementList);

		$.each(elementList, function(index, val) {
			$('#' + index).show();
			$('#' + index).css('top', val.top);
			$('#' + index).css('left', val.left);
		});
	});
	
}