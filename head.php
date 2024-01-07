    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/fontawesome-free-5.15.3-web/css/all.css">
	<script src="js/jquery-3.5.1.min.js"></script> 
	<script src="js/main.js"></script>
	<script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
<?php
	function titrePage($titre) { 
		if($titre == "classe") {
			echo '<link rel="stylesheet" href="css/classe.css">';
			echo '<script src="js/refreshList.js"></script> 
			<script src="js/refreshMsg.php?'.$_SERVER['QUERY_STRING'].'"></script>';
		}
		echo "<title>".strtoupper($titre)." - ESTE</title>";
	
	}
?>
