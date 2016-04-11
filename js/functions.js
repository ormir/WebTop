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