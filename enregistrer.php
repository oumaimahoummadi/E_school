<?php
    include('cnx.php');
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
<style>
    h2{width:100%;text-align:center ;float:left;font-size:40px;border-bottom:3px solid maroon ; margin-bottom:50px; padding:13px;}
    .wrapper{padding:0px;margin:0; width:600px;background: rgba(0, 0, 0,0.7)}
    label{color: #000;font-size:10px;color: #fff;float:left;}
    input{background:none;width:70%;float:right;color: #fff;margin-bottom:10px;}
    
    button{color: #fff;background:maroon;width:100%;border:2px solid maroon ;padding:3px;margin: 10px 0; cursor: pointer;} 
    p{font-size:20px;color: #fff;}
</style>
<body>
<section class="body home">
	<div class="container wrapper" class="login-box" style="width:550px;">
		<section class="signup users"  >
        <div class="container">
        <?php 
            if(isset($_GET['type_compte'])) {
                if($_GET['type_compte']!="etudiant" && $_GET['type_compte']!="enseignant") {
                    echo '<a href="?type_compte=etudiant">Créer un compte étudiant</a> OU <a href="?type_compte=enseignant">Créer un compte enseignant</a>';
                } else {
                    formEnregistrer($_GET['type_compte']);
                    if(isset($err)) {	
                        if($err != "") echo '<p style="color:red">'.$err.'</p>';
                    }
                }
            } else {
                echo '<a href="?type_compte=etudiant">Créer un compte étudiant</a> OU <a href="?type_compte=enseignant">Créer un compte enseignant</a>';
            }
        ?></div>
		</section>
	</div>
</section>
   
</body>
</html>