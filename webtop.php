<!-- Icons -->
<div id="fhtw_icon" class="desktopicon draggable" onclick="openWindow(fhtw_window)">
	<img src="images/book.png">
	<p>Technikum<br>Wien</p>
</div>
<div id="phpinfo_icon" class="desktopicon draggable" onclick="openWindow(phpinfo_window)">
	<img src="images/code.png">
	<p>PHP</p>
</div>
<div id="gallery_icon" class="desktopicon draggable" onclick="openWindow(gallery_window)">
	<img src="images/image.png">
	<p>Gallery</p>
</div>

<!-- Windows -->
<div id="phpinfo_window" class="window draggable ui-widget-header" >
	<img class="img-close" src="images/close.png">
	<div class="windowcontent ui-widget-content">
		<?php phpinfo(); ?>
	</div>
</div>

<div id="fhtw_window" class="window draggable">
	<img class="img-close" src="images/close.png">
	<div class="windowcontent">
		<iframe src="http://www.technikum-wien.at"></iframe>
	</div>
</div>

<div id="gallery_window" class="window draggable">
	<img class="img-close" src="images/close.png">
	<div class="windowcontent">
		<?php include 'includes/gallery.php'; ?>
	</div>
</div>

<?php include "includes/taskleiste.php"; ?>
