<?php
header('Content-Type: application/json');

if (isset($_POST['cityZIP'])) {
	echo '{"success": 1, "message": "hey"}';
} else {
	echo '{"success": 0, "message": "hey"}';
}

?>