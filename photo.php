<?php 
	require_once 'controller.php'; //which library are we reading? $controller=new Controller( 'img'); 

	$c=new Controller();
?>
<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <title>The Thousand Faces of Lapos</title>
    <meta name='description' content='The pure essence of Lapos'>
    <meta name='author' content='valQ'>
    <link rel='stylesheet' href='css/style.css'>
	
</head>

<body>
    <div class="container">
	<h1> The Thousand Faces of Lapos</h1>
        <?php $c->initPhoto('img'); ?>
		
    </div>
</body>

</html>
