<?php 
	$GLOBALS['connectDb'] = mysqli_connect('localhost','root','','enseignement_a_distance');
	$type_valide = array (
		'application/pdf' => 'pdf',
		'text/plain' => 'txt',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
		'application/msword' => 'doc',
		'application/x-zip-compressed' => 'zip',
		'image/png' => 'png',
		'image/jpeg' => 'jpg'
	);
	function iconFichier($ext) {
		switch($ext) {
			case 'docx': 
			case 'doc': return "word";
			case 'pdf': return "pdf";
			case 'txt': return "alt";
			case 'xlsx': return "excel";
			case 'zip': return "archive";
			case 'png':
			case 'jpg': return "image";
			default: return "file";
		}
	}
		
	$max_upload = min((int)(ini_get('upload_max_filesize')), (int)(ini_get('post_max_size')), (int)(ini_get('memory_limit')))*1024*1024;
	if(!empty($_POST) && !empty($_FILES["fichier"]) && $_FILES['fichier']['error'] == 0 && $_FILES['fichier']['size']<$max_upload && $_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT") {
		$nom_destionation = basename($_POST['intitule']);
		if(in_array($_FILES["fichier"]['type'], array_keys($type_valide))) {
			
			$hash_fichier = hash_file("md5", $_FILES["fichier"]['tmp_name']);
			$query = "SELECT ID, DATE_ECHEANCE, INTITULE, CLASSE, TYPE_AJOUT FROM cours WHERE HASH_FICHIER='$hash_fichier' AND INTITULE='".$_POST['intitule']."' AND CLASSE=".$_POST['classe']." AND TYPE_AJOUT=".$_POST['type_ajout']." AND TYPE_FICHIER='".$type_valide[$_FILES["fichier"]['type']]."'";
			$fichier = mysqli_query($GLOBALS['connectDb'], $query);
			if(mysqli_num_rows($fichier) == 0) {
				if(move_uploaded_file($_FILES["fichier"]['tmp_name'] , "cours/".$nom_destionation.".".$type_valide[$_FILES["fichier"]['type']])) {
					if(isset($_POST['echeance'])) $query = "INSERT INTO cours (DATE_ECHEANCE, INTITULE, CLASSE, TYPE_AJOUT, HASH_FICHIER, TYPE_FICHIER) VALUES ('".$_POST['echeance']."', '".$_POST['intitule']."',".$_POST['classe'].",".$_POST['type_ajout'].",'".$hash_fichier."', '".$type_valide[$_FILES["fichier"]['type']]."')";
					else $query = "INSERT INTO cours (INTITULE, CLASSE, TYPE_AJOUT, HASH_FICHIER, TYPE_FICHIER) VALUES ('".$_POST['intitule']."',".$_POST['classe'].",".$_POST['type_ajout'].",'".$hash_fichier."', '".$type_valide[$_FILES["fichier"]['type']]."')";
					if(mysqli_query($GLOBALS['connectDb'], $query)) echo "<h2 class='succes'>Votre fichier a bien été transferé!</h2>";
					else echo "<h2 class='erreur'>Erreur lors de l'enregistrement du fichier</h2>";
				} else {
					echo "<h2 class='erreur'>Une erreur s'est produite, veuillez vérifier les données entrées</h2>";
				}
			} else {
				$fichier = mysqli_fetch_assoc($fichier);
				echo '<h2 class="info">Ce fichier a déjà été ajouté le '.$fichier['DATE_ECHEANCE'].' sous l\'intitulé: '.$fichier['INTITULE']."</h2>";
			}
		} else{
			echo "<h2 class='erreur'>Une erreur s'est produite, veuillez vérifier les données entrées</h2>";
		}
	} elseif(isset($_POST['edit_echeance']) && isset($_POST['devoir']) && $_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT") {
		$query = "UPDATE cours SET DATE_ECHEANCE='".$_POST['edit_echeance']."' WHERE ID=".$_POST['devoir'];
		$fichier = mysqli_query($GLOBALS['connectDb'], $query);
	} elseif(isset($_POST['suppr_devoir']) && $_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT") { 
		$query = "SELECT INTITULE, TYPE_FICHIER FROM cours WHERE ID=".$_POST['suppr_devoir'];
		$res_fichier = mysqli_query($GLOBALS['connectDb'], $query);
		if(mysqli_num_rows($res_fichier) == 1) {
			$fichier = mysqli_fetch_assoc($res_fichier);
			unlink("cours/".basename($fichier['INTITULE'].".".$fichier['TYPE_FICHIER']));
			$query = "DELETE FROM cours WHERE ID=".$_POST['suppr_devoir'];
			$fichier = mysqli_query($GLOBALS['connectDb'], $query);
		}
	} elseif(isset($_POST['suppr_soumis']) && $_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT") { 
		$query = "SELECT HASH_FICHIER, TYPE_FICHIER FROM devoir WHERE ID=".$_POST['suppr_soumis'];
		$res_fichier = mysqli_query($GLOBALS['connectDb'], $query);
		if(mysqli_num_rows($res_fichier) == 1) {
			$fichier = mysqli_fetch_assoc($res_fichier);
			unlink("devoirs/".basename($fichier['HASH_FICHIER'].".".$fichier['TYPE_FICHIER']));
			$query = "DELETE FROM devoir WHERE ID=".$_POST['suppr_soumis'];
			$fichier = mysqli_query($GLOBALS['connectDb'], $query);
		}
	} elseif(isset($_POST['note']) && isset($_POST['remarques']) && isset($_POST['devoir']) && $_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT") { 
		$query = "UPDATE devoir SET NOTE=".$_POST['note'].", REMARQUES='".$_POST['remarques']."' WHERE ID=".$_POST['devoir'];
		$res_fichier = mysqli_query($GLOBALS['connectDb'], $query);
	} elseif(isset($_POST['ennonce']) && !empty($_FILES["fichier"]) && $_FILES['fichier']['error'] == 0 && $_FILES['fichier']['size']<$max_upload && $_SESSION['utilisateur']['type_compte'] == "ETUDIANT") {
		if(in_array($_FILES["fichier"]['type'], array_keys($type_valide))) {
			
			$hash_fichier = hash_file("md5", $_FILES["fichier"]['tmp_name']);
			$query = "SELECT ID, DATE_ENVOI, COURS, ETUDIANT, NOTE, REMARQUES FROM devoir WHERE HASH_FICHIER='$hash_fichier'";
			$fichier = mysqli_query($GLOBALS['connectDb'], $query);
			if(mysqli_num_rows($fichier) == 0) {
			  if(move_uploaded_file($_FILES["fichier"]['tmp_name'] , "devoirs/".$hash_fichier.".".$type_valide[$_FILES["fichier"]['type']])) {
				$query = "INSERT INTO devoir (COURS, ETUDIANT, HASH_FICHIER, TYPE_FICHIER) VALUES (".$_POST['ennonce'].", ".$_SESSION['utilisateur']['ID'].",'".$hash_fichier."','".$type_valide[$_FILES["fichier"]['type']]."')";
				if(mysqli_query($GLOBALS['connectDb'], $query)) echo "<h2 class='succes'>votre devoir a bien été remis!";
				else echo "<h2 class='erreur'>Erreur lors de l'enregistrement du fichier</h2>";
			  } else {
					echo "<h2 class='erreur'>Une erreur s'est produite, veuillez vérifier les données entrées</h2>";
			  }
			} else {
				$fichier = mysqli_fetch_assoc($fichier);
				echo '<h2 class="erreur">Ce cours a déjà été ajouté le '.$fichier['DATE_ECHEANCE'].' sous l\'intitulé: '.$fichier['INTITULE'].'</h2>';
			}
		} else{
			echo '<h2 class="erreur">Une erreur s\'est produite, veuillez vérifier les données entrées</h2>';
		}
	}
	echo '<script src="js/echeance.js"></script>';
	if($_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT") {
		echo '<section class="sections text-center">
			<h1>Ajouter un cours ou un devoir</h1>
			<form method="POST" enctype="multipart/form-data" action="">
				<label for="classe">Intitulé du document: </label>
				<input name="intitule" type="txt" required><br>
				<label for="classe">Classe: </label>
				<select name="classe" id="classe" required>
					<option value=""></option>';
					foreach($_SESSION['utilisateur']['classes'] as $i => $filiere) echo '<option value="'.$i.'">'.$_SESSION['utilisateur']['classes'][$i]['NOM'].'</option>'; 
				echo '</select><br>
				<label for="type_ajout">Type ajout: </label>
				<input type="radio" onclick="dateEcheance(0);" name="type_ajout" id="ajout_cours" value="0" required><label for="ajout_cours"> cours </label> 
				<input type="radio" onclick="dateEcheance(1);" name="type_ajout" id="ajout_exercice" value="1"><label for="ajout_exercice"> exercice </label><br>
				<div id="echeance"></div>
				<label>Fichier à taille maximum de '.(($max_upload/1024)/1024).'Mo.</label>
				<input type="file" name="fichier" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf,.txt,.zip,.xlsx">
				<input type="submit" value="Ajouter">
			</form>
		</section><script>function dateEcheance(afficher) {
				if(afficher==1) $("#echeance").html(\'<label for="date_echeance">Echéance: </label><input type="date" id="date_echeance" name="echeance">\');
				else $("#echeance").html(\'\');
			} 
		</script>';
		echo '<section class="sections text-center"><h1>Cours & Devoirs</h1>';
			$query = "SELECT * FROM cours WHERE CLASSE IN (SELECT ID FROM CLASSE WHERE ENSEIGNANT=".$_SESSION['utilisateur']['ID'].")";
			$res_fichier = mysqli_query($GLOBALS['connectDb'], $query);
			echo '<table style="border: 1px solid red;"><thead><tr><th>TYPE</th><th>DATE ECHEANCE</th><th>CLASSE</th><th>INTITULE</th><th></th><tr></thead><tbody>';
			while($fichier = mysqli_fetch_assoc($res_fichier)) {
				$icon = iconFichier($fichier['TYPE_FICHIER']);
				echo '<tr><td onclick="$(\'.devoir_remis\').hide(); $(\'.soumis_'.$fichier['ID'].'\').show();"><a href="#">';
						if($fichier['TYPE_AJOUT']==0) {
							echo '<i class="fas fa-chalkboard-teacher"></i>';
						}else{
							echo '<i class="fas fa-file-signature"></i>';
							$query = "SELECT * FROM devoir WHERE COURS=".$fichier['ID'];
							$res_devoir = mysqli_query($GLOBALS['connectDb'], $query);
							$total_soumis = mysqli_num_rows($res_devoir);
							echo " (".$total_soumis.") ";
						}
					echo '</a></td>';
					if($fichier['TYPE_AJOUT']==0) {
						echo '<td>'.$fichier['DATE_ECHEANCE'];
					} else {
						echo '<td id="echeance_'.$fichier['ID'].'" class="echeance" onclick="editEcheance('.$fichier['ID'].', \''.explode(" ",$fichier['DATE_ECHEANCE'])[0].'\', compteur_'.$fichier['ID'].');">';
						echo '</td><script>var compteur_'.$fichier['ID'].' = compteARebour('.$fichier['ID'].', "'.$fichier['DATE_ECHEANCE'].'");</script>';
					}
					echo '<td>'.$_SESSION['utilisateur']['classes'][$fichier['CLASSE']]['NOM'].'</td><td><a href="cours/'.$fichier['INTITULE'].".".$fichier['TYPE_FICHIER'].'"> <i class="fas fa-file-'.$icon.'"></i>  '.$fichier['INTITULE'].'</a></td>
					<td><form action="" method="POST"><input type="hidden" name="suppr_devoir" value="'.$fichier['ID'].'"><button type="submit"><i class="fas fa-trash-alt"></i></button></form></td>
				</tr>';
				if($total_soumis>0) {
					echo '<tr class="soumis_'.$fichier['ID'].' devoir_remis"><th></th><th>ETUDIANT</th><th>DATE REMISE</th><th>FICHIER</th><th>NOTE & REMARQUES</th></tr>';
					while($soumis = mysqli_fetch_assoc($res_devoir)) {
						echo '<tr class="soumis_'.$fichier['ID'].' devoir_remis">';
						$etudiant = $_SESSION['utilisateur']['classes'][$fichier['CLASSE']]['ETUDIANT'][$soumis['ETUDIANT']];
						echo '<td><form action="" method="POST"><input type="hidden" name="suppr_soumis" value="'.$soumis['ID'].'"><button type="submit"><i class="fas fa-times-circle"></i></button></form></td><td>'.$etudiant['NOM'].' '.$etudiant['PRENOM'].'</td><td>'.$soumis['DATE_ENVOI'].'</td><td><a href="devoirs/'.$soumis['HASH_FICHIER'].".".$soumis['TYPE_FICHIER'].'"><i class="fas fa-file-download"></i></a>'.'</td><td><form action="" method="POST"><input type="hidden" name="devoir" value="'.$soumis['ID'].'"><input placeholder="Note / 20" type="txt" class="note" name="note" value="'.$soumis['NOTE'].'"> <input type="txt" name="remarques" placeholder="Remarques..." value="'.$soumis['REMARQUES'].'"><button type="submit"><i class="fas fa-pen"></i></button></form></td>';
						echo '</tr>';
					}
				}
				
			}
		echo '</tbody></table></section><style>.devoir_remis th{background:#965116;}.devoir_remis{display:none;text-align:right;font-size:18px; color:#965116;} .input[type=txt]{width:45%; border:2px solid #965116; color:#965116;}</style>';
	} elseif($_SESSION['utilisateur']['type_compte'] == "ETUDIANT") {
			echo '<section class="sections text-center"><h1>Mes cours & Devoirs</h1>';
			if($_GET['cours']!="") $query = "SELECT * FROM cours WHERE CLASSE=".$_GET['cours'];
			$res_fichier = mysqli_query($GLOBALS['connectDb'], $query);
			echo '<table><thead><th>TYPE</th><th>DATE ECHEANCE</th><th>INTITULE</th><th>DEVOIR</th></thead><tbody>';
			while($fichier = mysqli_fetch_assoc($res_fichier)) {
				$icon = iconFichier($fichier['TYPE_FICHIER']);
				echo '<tr><td>';
						if($fichier['TYPE_AJOUT']==0) echo '<i class="fas fa-chalkboard-teacher"></i>';
						else echo '<i class="fas fa-file-signature"></i>';
					echo '</td>';
					if($fichier['TYPE_AJOUT']==0) echo '<td>'.$fichier['DATE_ECHEANCE'];
					else echo '<td id="echeance_'.$fichier['ID'].'" class="echeance">';
					echo '</td><script>var compteur_'.$fichier['ID'].' = compteARebour('.$fichier['ID'].', "'.$fichier['DATE_ECHEANCE'].'");</script>
					<td><a href="?cours/'.$fichier['INTITULE'].".".$fichier['TYPE_FICHIER'].'"> <i class="fas fa-file-'.$icon.'"></i>  '.$fichier['INTITULE'].'</a></td><td>';
					if($fichier['TYPE_AJOUT']==1) {
						$date_echeance = new DateTime($fichier['DATE_ECHEANCE']);
						$aujourdhui = new DateTime();
						$query = "SELECT ID, DATE_ENVOI, NOTE, REMARQUES FROM devoir WHERE ETUDIANT=".$_SESSION['utilisateur']['ID']." AND COURS=".$fichier['ID'];
						$res_devoir = mysqli_query($GLOBALS['connectDb'], $query);
						
						if(mysqli_num_rows($res_devoir)==1) $devoir = mysqli_fetch_assoc($res_devoir);
						
						if($date_echeance > $aujourdhui) {
							if(!isset($devoir)) {
								echo '<form id="form_devoir" method="POST" enctype="multipart/form-data" action=""><input type="hidden" name="ennonce" value="'.$fichier['ID'].'"><input type="file" name="fichier" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf,.txt,.zip,.xlsx" onchange="';
								echo "$('#form_devoir').submit();";
								echo '"></form>';
							} else {
								if($devoir['NOTE'] === null) echo 'Envoyé le: '.$devoir['DATE_ENVOI'];
								else echo 'Corrigé Note: '.$devoir['NOTE'].'/20';
								unset($devoir);
							}
						} else {
							if(!isset($devoir)) {
								echo 'Délai d\'envoi dépassé.';
							} else {
								if($devoir['NOTE'] === null) echo 'Envoyé le: '.$devoir['DATE_ENVOI'];
								else echo 'Corrigé Note: '.$devoir['NOTE'].'/20';
								unset($devoir);
							}
						}
					}
				echo '</td></tr>';
			}
		echo '</tbody></table></section>';
	}
echo '<style>
	table{ width:100%; }
	td, th{padding: 5px;}
	th {background: #7caeba; color: white; border: 1px solid white;}
	td {border: 1px solid #7caeba;}
	.echeance {color:red; cursor: grab;}
	button {border: none; color: red; background:white;}
	input, select, {hight:50px;width:40%;}
	h1{color:#965116;}
	.erreur{color:red;}
	.info{color:orange;}
	.succes{color:green;}
</style>';
?>
