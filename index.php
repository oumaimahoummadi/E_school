<?php
    if (session_status() == PHP_SESSION_NONE) { session_start(); }
	if(isset($_GET['logout'])) { session_destroy(); header('Location: .'); }
    if((isset($_GET['classe']) || isset($_GET['cours'])) && !isset($_SESSION['utilisateur'])){ header('Location: authentification.php'); }
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once('head.php'); 
	
		if(isset($_GET['classe'])) titrePage("classe");
		if(isset($_GET['cours'])) titrePage("cours");
		else titrePage("Bienvenue");
	
	?>
</head>

<body >
	<?php include_once('header.php'); ?>
	<?php 
		if(isset($_GET['classe'])) include_once('classe.php');
		if(isset($_GET['cours'])) include_once('cours.php'); 
		else include_once('accueil.php');
	?>
    <?php include_once('footer.php'); ?>
    </body>
</html>