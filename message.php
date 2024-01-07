<?php
	if (session_status() == PHP_SESSION_NONE) { session_start(); }
	$GLOBALS['connectDb'] = mysqli_connect('localhost','root','','enseignement_a_distance') ;
		if(isset($_GET['classe'])) { $idclasse = $_GET['classe']; }
	if(isset($_POST['message'])) { $message = strip_tags($_POST['message']); }  
	
    if($_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT") {
        if(isset($idclasse)) { $_SESSION['utilisateur']['classe'] = $_SESSION['utilisateur']['classes'][$idclasse]; }
		if(isset($_GET['etudiant'])) { $etudiant = $_GET['etudiant']; } else { $etudiant = 0; }
		if(isset($idclasse) && isset($message)) {
			if(!empty($message)) {
				$query = "INSERT INTO message (classe, etudiant, message, sens) VALUES (".$idclasse.", ".$etudiant.", '".$message."', 1)";
				$results = mysqli_query($GLOBALS['connectDb'], $query);
			}
		}
    }
	
	if($_SESSION['utilisateur']['type_compte'] == "ETUDIANT") {
		if(isset($idclasse) && isset($message)) {
			if(!empty($message)) {
				$query = "INSERT INTO message (classe, etudiant, message, sens) VALUES (".$idclasse.", ".$_SESSION['utilisateur']['ID'].", '".$message."', 0)";
				$results = mysqli_query($GLOBALS['connectDb'], $query);
			}
		}
    }
	
	if(isset($_GET['classe'])) {
		if(!isset($_GET['etudiant'])) listeMessages($_GET['classe']);
		else listeMessages($_GET['classe'], $_GET['etudiant']);
	}
		
    function listeMessages($classe, $etudiant="0") {
		if($_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT") {
			if($etudiant=="0") $query = "SELECT * FROM message WHERE CLASSE=".$classe;
			else $query = "SELECT * FROM message WHERE ETUDIANT=".$etudiant." AND CLASSE=".$classe;
		} elseif($_SESSION['utilisateur']['type_compte'] == "ETUDIANT") {
			$query = "SELECT * FROM message WHERE (ETUDIANT=0 OR ETUDIANT=".$_SESSION['utilisateur']['ID'].") AND CLASSE=".$classe;
		}
        $results = mysqli_query($GLOBALS['connectDb'], $query);
        for($i=0; $i<mysqli_num_rows($results); $i++)  {
            $message = mysqli_fetch_assoc($results);
			//var_dump($message);
			if($_SESSION['utilisateur']['type_compte']=="ETUDIANT") {
				$sens = ($message['SENS']=='1')?'incoming':'outgoing';
			} elseif($_SESSION['utilisateur']['type_compte']=="ENSEIGNANT") {
				$sens = ($message['SENS']=='1')?'outgoing':'incoming';
			}
			echo '<div class="chat '.$sens.'">'; //id="'.$message['ID'].'"
				if($sens == "incoming") echo '<i class="img fa fa-user-circle "></i>';
				echo '<div class="details"><p';
				if($_SESSION['utilisateur']['type_compte']=="ETUDIANT" && $message['ETUDIANT']!="0" && $message['SENS']=='1') echo ' style="color:red;" ';
				echo '>';
				if($message['SENS']=='0' && $_SESSION['utilisateur']['type_compte']=="ENSEIGNANT") echo '<sup>'.$_SESSION['utilisateur']['classes'][$classe]['ETUDIANT'][$message['ETUDIANT']]['NOM'].' '.$_SESSION['utilisateur']['classes'][$classe]['ETUDIANT'][$message['ETUDIANT']]['PRENOM'].'</sup>';
				if($message['ETUDIANT']!=0 && $message['SENS']=='1' && $_SESSION['utilisateur']['type_compte']=="ENSEIGNANT") echo '<sup>'.$_SESSION['utilisateur']['classes'][$classe]['ETUDIANT'][$message['ETUDIANT']]['NOM'].' '.$_SESSION['utilisateur']['classes'][$classe]['ETUDIANT'][$message['ETUDIANT']]['PRENOM'].'</sup>';
			echo $message['MESSAGE'].'<sub>'.$message['DATE_ENVOI'].'</sub></p></div></div>';
		}
		echo '<script> $("#msg").animate({ scrollTop: $("#msg")[0].scrollHeight });</script>';
    }
	

?>