<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

$GLOBALS['connectDb'] = mysqli_connect('localhost','root','','enseignement_a_distance') ;

$query = "SELECT ID, NOM FROM module";
$results = mysqli_query($GLOBALS['connectDb'], $query);
$_SESSION['nom_module'] = array();
for ($i=0;$i<mysqli_num_rows($results);$i++) {
	$module = mysqli_fetch_assoc($results);
	$_SESSION['nom_module'][$module['ID']] = $module['NOM'];
}
$query = "SELECT ID, NOM, ABREVIATION FROM FILIERE";
$results = mysqli_query($GLOBALS['connectDb'], $query);
$_SESSION['nom_filiere'] = array();
for ($i=0;$i<mysqli_num_rows($results);$i++) {
	$module = mysqli_fetch_assoc($results);
	$_SESSION['nom_filiere'][$module['ID']] = array('NOM'=>$module['NOM'], 'ABREVIATION'=>$module['ABREVIATION']);
}
$query = "SELECT ID, NOM, PRENOM FROM ENSEIGNANT";
$results = mysqli_query($GLOBALS['connectDb'], $query);
$_SESSION['nom_enseignant'] = array();
for ($i=0;$i<mysqli_num_rows($results);$i++) {
	$module = mysqli_fetch_assoc($results);
	$_SESSION['nom_enseignant'][$module['ID']] = array('NOM'=>$module['NOM'], 'PRENOM'=>$module['PRENOM']);
}

//mysqli_query($GLOBALS['connectDb'], "UPDATE enseignant SET MOT_DE_PASSE='123'");
//exit;

function formEnregistrer($type_compte) {
	unset($_SESSION['enregistrement']);
	unset($_SESSION['table']);
	$_SESSION['table'] = strtoupper($type_compte);
	$results = mysqli_query($GLOBALS['connectDb'], "SHOW COLUMNS FROM ".$_SESSION['table']);
	echo '<form method="post" class="form">';
	echo '<!-- <img src="user.png">  -->';
	echo '<h2><u>ESPACE '.$_SESSION['table'].'<u></h2>';
	$colonne = array();
	for ($i=0;$i<mysqli_num_rows($results);$i++) {
		$nom_champs = mysqli_fetch_assoc($results)['Field'];
		if($nom_champs != 'ID') {
			$_SESSION['enregistrement'][$nom_champs] = "";
			echo '<div class="input">
				<input name="'.$nom_champs.'" id="'.$nom_champs.'"  value="';
				if(isset($_SESSION['enregistrement'][$nom_champs])) echo $_SESSION['enregistrement'][$nom_champs];
				echo '" required  type="';
				if($nom_champs == 'MOT_DE_PASSE') { echo "password"; } else { echo "text"; }
				echo '">';
				echo '<label for="'.$nom_champs.'"> <b>'.str_replace("_"," ",$nom_champs).'</b></label>';
			echo '</div>';
			if($nom_champs == 'MOT_DE_PASSE') {
				echo '<div class="input"><input name="RE_'.$nom_champs.'" id="RE_'.$nom_champs.'"  value="';
				if(isset($_SESSION['enregistrement']['RE_'.$nom_champs])) echo $_SESSION['enregistrement']['RE_'.$nom_champs];
				echo '" required  type="password" required>';
				echo '<label for="RE_'.$nom_champs.'"> <b>Rentrer le '.str_replace("_"," ",$nom_champs).'</b></label></div>';
				$_SESSION['enregistrement']['RE_'.$nom_champs] = "";
			}
		}
	}

	foreach($_SESSION['enregistrement'] as $nom_champs => $valeur) {
		//
	}
	echo '<button type="submit" class="btn" name="enregistrer_'.$_SESSION['table'].'">S\'enregistrer</button>';
	echo '<a href="authentification.php">Déjà enregsitré, Connectez-vous</a>';
	echo '</form>';
	echo '<script src="js/cnx.js"></script>';
}

// INSCRIPTION---------------------------------etudiant/enseignant---------------
if(isset($_SESSION['table'])) {
	if(isset($_POST['enregistrer_'.$_SESSION['table']])) {
		$erreur = false;
	
		foreach($_SESSION['enregistrement'] as $nom_champs => $valeur) {
			if(isset($_POST[$nom_champs])) {
				$_SESSION['enregistrement'][$nom_champs] = mysqli_real_escape_string($GLOBALS['connectDb'], $_POST[$nom_champs]);
			}
		}
	   
		foreach($_SESSION['enregistrement']  as $nom_champs => $valeur) {
			if(empty($_SESSION['enregistrement'][$nom_champs])) $erreur = true;
		}
	
		//VERIFICATION___________________________________
		if(isset($_SESSION['enregistrement']['RE_MOT_DE_PASSE']) && isset($_SESSION['enregistrement']['MOT_DE_PASSE'])) {
			if($_SESSION['enregistrement']['RE_MOT_DE_PASSE'] != $_SESSION['enregistrement']['MOT_DE_PASSE']){
				$_SESSION['enregistrement']['RE_MOT_DE_PASSE'] = "";
				$erreur = true;
			} else {
				unset($_SESSION['enregistrement']['RE_MOT_DE_PASSE']);
			}
		} else {
			$erreur = true;
		}
		//AJOUTER DANS La TABLE_____etudiant et ens..______________________
		if (!$erreur) {
			// $password = md5($password);
			$err = "";
			$query = "SELECT * FROM ".$_SESSION['table']." WHERE EMAIL_DE_".$_SESSION['table']."='".$_SESSION['enregistrement']['EMAIL_DE_'.$_SESSION['table']]."'";
			$results = mysqli_query($GLOBALS['connectDb'], $query);
			if (mysqli_num_rows($results)==0) {
				$query = "INSERT INTO ".$_SESSION['table']." (".implode("," , array_keys($_SESSION['enregistrement'])).") VALUES ('".implode("','" , $_SESSION['enregistrement'])."')";
				if(mysqli_query($GLOBALS['connectDb'] , $query)) {
					$query = "SELECT * FROM ".$_SESSION['table']." WHERE EMAIL_DE_".$_SESSION['table']."='".$_SESSION['enregistrement']['EMAIL_DE_'.$_SESSION['table']]."'";
					$results = mysqli_query($GLOBALS['connectDb'], $query);
					var_dump(mysqli_num_rows($results));
					if (mysqli_num_rows($results)==1){
						//$_SESSION['email']= $email;
						$_SESSION['utilisateur'] = infoUtilisateur($_SESSION['enregistrement']['EMAIL_DE_'.$_SESSION['table']]);
						unset($_SESSION['enregistrement']);
						// setcookie("u_idAvxDj", $SqlUserId->id, time()+60*60*24*7*30);
						// setcookie("loginAXvxDj", 1, time()+60*60*24*7*30);
						header('location: .');
						// echo 'your id is '.id; echo 'your login is '.login;
					} else {
						$err .= "<br>Erreur lors de l'enregistrement.";
					}
				}
			} else {
				$err .= "<br>Email déjà utilisé";
			}
			//header('location:accueil.php');
		}else{
			header('location: enregistrer.php?type_compte='.$_SESSION['table']);
		}
	}
}

if (isset($_POST['connecter'])) {
	$erreur = "";
	if(isset($_POST['type_compte']) ) {
		if($_POST['type_compte']!="ETUDIANT" && $_POST['type_compte']!="ENSEIGNANT") 
			$erreur = "Choissir le type de compte: Etudiant ou Enseignant";
	} else {
		header("Location: authentification.php");
	}
	$_SESSION['table'] = $_POST['type_compte'];
	if(!isset($_POST['EMAIL_DE_'.$_POST['type_compte']]) || !isset($_POST['type_compte'])) {
		header("Location: authentification.php");
	}

    $email = mysqli_real_escape_string($GLOBALS['connectDb'], $_POST['EMAIL_DE_'.$_POST['type_compte']]);
    $mdp = mysqli_real_escape_string($GLOBALS['connectDb'], $_POST['MOT_DE_PASSE']);

    if (empty($email)){ $erreur .= "<br>Entrez votre Email."; }
    if (empty($mdp)){ $erreur .= "<br>Entrez votre mot de passe."; }

    if ($erreur == "") {
        //$password=md5($password);
        $query = "SELECT * FROM ".$_POST['type_compte']." WHERE EMAIL_DE_".$_POST['type_compte']."='".$email."' AND MOT_DE_PASSE='".$mdp."'";
        $results = mysqli_query($GLOBALS['connectDb'], $query);
        if (mysqli_num_rows($results)==1){
            //$_SESSION['email']= $email;
			$_SESSION['utilisateur'] = infoUtilisateur($_POST['EMAIL_DE_'.$_POST['type_compte']]);
			/*echo '<pre>';
			print_r($_SESSION['utilisateur']);
			echo '</pre>';
			exit;*/
			// $SqlUserId = mysqli_fetch_object($results);
			// setcookie("u_idAvxDj", $SqlUserId->id, time()+60*60*24*7*30);
			// setcookie("loginAXvxDj", 1, time()+60*60*24*7*30);
			header('location: .');
			// echo 'your id is '.id; echo 'your login is '.login;
        } else {
            $erreur .= "<br>Email ou Mot de passe incorrect.";
		}
    }
}

function infoUtilisateur($mail) {
	$info = array();
	$query = "SELECT * FROM ".$_SESSION['table']." WHERE EMAIL_DE_".$_SESSION['table']."='".$mail."'";
	$results = mysqli_query($GLOBALS['connectDb'], $query);
	var_dump(mysqli_num_rows($results));
	if (mysqli_num_rows($results)==1){
		//$_SESSION['email']= $email;
		$info = mysqli_fetch_assoc($results);
		$info['type_compte'] = $_SESSION['table'];
		if($info['type_compte']=="ETUDIANT") {
			$query = "SELECT ID, NOM, ABREVIATION FROM filiere WHERE ID=".$info['FILIERE'];
			$results = mysqli_query($GLOBALS['connectDb'], $query);
			if (mysqli_num_rows($results)==1){
				$info['classe'] = mysqli_fetch_assoc($results);
				$query = "SELECT CODE_MODULE, MODULE, SEMESTRE FROM classe WHERE FILIERE=".$info['FILIERE'];
				$results = mysqli_query($GLOBALS['connectDb'], $query);
				for ($i=0;$i<mysqli_num_rows($results);$i++){
					$module = mysqli_fetch_assoc($results);
					$semestre = $module['SEMESTRE'];
					unset($module['SEMESTRE']);
					$info['classe']['modules'][$semestre][] = $module;
					$indice = count($info['classe']['modules'][$semestre]) - 1;
					$info['classe']['modules'][$semestre][$indice]['NOM'] = $_SESSION['nom_module'][$info['classe']['modules'][$semestre][$indice]['MODULE']];
				}
			}
		}
	}
	return $info;
}

// if(isset($_POST['uploadFile'])){
// 	$file_name=$_FILES['fichier']['name'];
// 	$fileDestination="../uploadedFiles/".$file_name;

// $req=('INSERT INTO cours(intitule, url) VALUES (?,?)');
// $req->execute(array($file_name,$fileDestination));


// }

//CONTAAACT---------
// if(isset($_POST['envoyer'])){

// 	$errors = array();

// 	//LIER AVEC LE FORMULAIRE_______________________________
	
// 	$first_name = mysqli_real_escape_string($GLOBALS['connectDb'],$_POST['first_name']);
// 	$last_name = mysqli_real_escape_string($GLOBALS['connectDb'],$_POST['last_name']);
// 	$email = mysqli_real_escape_string($GLOBALS['connectDb'],$_POST['email']);
// 	$message = mysqli_real_escape_string($GLOBALS['connectDb'],$_POST['entrer ca']);
	
	
	//VERIFICATION__________________________________
	
// 	if(empty($first_name)){array_push($errors, "Fullname is requiered");}
// 	if(empty($last_name)){array_push($errors, "entrer ton prenom");}
// 	if(empty($email)){array_push($errors, "entrer ton mail");}
// 	if(empty($message)){array_push($errors, "entrer le pw");}


// 	if (count($errors) == 0){
// 		$password = md5($password);
// 		$query = "INSERT INTO contact (first_name,last_name,email,message,) VALUES ('$first_name','$last_name','$email','$message')";
// 		$a = mysqli_query($GLOBALS['connectDb'],$query);
		
// 		echo $first_name ."-".
// 		$last_name ."-".
// 		$email ."-".
// 		$message  ."-";
		
// 		$_SESSION['last_name'] = $last_name;
// 		$_SESSION['success'] = "Login Successful";
// 		header('location: home.php');
// 	}
// }

	
	


?>


