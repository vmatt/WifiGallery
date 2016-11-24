<?php 
	require_once 'controller.php'; 
	$c=new Controller();
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <title>Instant Gallery</title>
    <meta name='description' content='Be van fejezve a nagy mű, igen. A gép forog, az alkotó pihen. Év-milliókig eljár tengelyén, Míg egy kerékfogát ujítni kell.'>
	<meta http-equiv="refresh" content="5">
    <meta name='author' content='valQ'>
    <link rel='stylesheet' href='css/style.css'>
	<link rel="stylesheet" href="css/justifiedGallery.min.css" />
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/jquery.justifiedGallery.min.js"></script>
</head>

<body>

    <div class="container">
	<h1>Instant Gallery</h1>
	<p>Be van fejezve a nagy mű, igen. A gép forog, az alkotó pihen. Év-milliókig eljár tengelyén, Míg egy kerékfogát ujítni kell.</p><br>
        <?php $c->initSite('img'); ?>
			<script>
			
			/*a JS csak azért van, hogy a képek a lehető leghelytakarékosabban jelenjenek meg*/
			$('#gallery').justifiedGallery({
				rowHeight : 200,
				maxRowHeight:400,
				lastRow : 'justify',
				margins : 3
			});
	</script>
    </div>
</body>

</html>
