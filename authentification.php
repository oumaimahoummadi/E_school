<?php include('cnx.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once('head.php'); 
	
		if(isset($_GET['classe'])) titrePage("classe");
		if(isset($_GET['cours'])) titrePage("cours");
		else titrePage("Bienvenue");
	
	?>
</head>
<style>
@import "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css)";
header{background-color:black;}
.wrapper{background: rgba(0, 0, 0,0.7)}
#login-box h2{float:left;font-size:40px;border-bottom:6px solid maroon ; margin-bottom:50px; padding:13px;color: #fff;}
#textbox{width:100%;overflow:hidden;font-size:20px;padding:8px 0 ;margin:8px 0;border-bottom:1px solid maroon ;}
#textbox i{float:left;font-size:20px;margin:10px;}
#textbox input{border:none ;outline:none;background:none;width:80%;font-size:18px;float:left;margin:10px;color: #fff;}
.p{font-size:20px;color: #fff;}
#btn{background:none;width:100%;border:2px solid maroon ;color: #000; padding:3px;margin: 10px 0; cursor: pointer;color: #fff;}
</style>

<body >
<?php 
// include_once('header.php'); 
?>
<section class="body home">
	<div class="wrapper" class="login-box">	
        <section class="users">
			<div class="container">
				<form method="post" class="form" id="auth">
					<!-- <img src="user.png">  -->
					<center><h2>Authentification</h2></center> 
					<div class="input" id="textbox">
						<!-- <label for="EMAIL">Email</label> -->
						<i class="fa fa-user"></i>
						<input type="text" name="EMAIL" id="EMAIL" placeholder="EMAIL" value="" required>
						
					</div>
					<div class="input" id="textbox">
						<!-- <label for="MOT_DE_PASSE">Mot de passe</label> -->
						<i class="fas fa-lock"></i>
						<input type="password" name="MOT_DE_PASSE"  id="MOT_DE_PASSE" placeholder="Mot de passe" value="" required>
						
					</div>
					<center>
					<div class="input">
						<input type="radio" name="type_compte"  id="ETUDIANT" value="ETUDIANT" onchange="majChampsMail(this.id)" required>
						<label for="ETUDIANT"> Etudiant</label>
						<input type="radio" name="type_compte"  id="ENSEIGNANT" value="ENSEIGNANT" onchange="majChampsMail(this.id)" required>
						<label for="ENSEIGNANT"> Enseignant</label>
					</div>
					<input type="hidden" name="connecter">
					<button id="btn" type="button" class="btn" onclick="authentification()"><p><b>Se connecter</b></p></button>
					<!-- <a href="#forgot-pw" class="forgot-pw">forgot password?</a> -->
					<p class="p"> Vous n'avez pas un compte ? <a href="enregistrer.php" >Inscrire ici</a></p></center>
					<?php if(isset($erreur)) {	
						if($erreur != "") echo '<p style="color:red">'.$erreur.'</p>';
					} ?>
				</form>	
			</div>
		</section>
    </div>
</section>
	<script> 
		function majChampsMail(type_compte) { document.getElementById("EMAIL").name = "EMAIL_DE_"+type_compte; }
		function authentification() {
			if(document.getElementById("EMAIL").name != "") {
				document.getElementById("auth").submit();
			} else {
				alert("Choisir le type de compte");
			}
		}

	</script>
<?php 
// include_once('footer.php'); ?>
</body>
</html>