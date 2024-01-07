<?php 
    if(!isset($_SESSION['utilisateur'])) session_start();
    $GLOBALS['connectDb'] = mysqli_connect('localhost','root','','enseignement_a_distance') ;

    $query = "UPDATE ".$_SESSION['utilisateur']['type_compte']." SET ENLIGNE_DEPUIS='".date("Y-m-d H:i:s",time())."' WHERE ID=".$_SESSION['utilisateur']['ID'];
    $results = mysqli_query($GLOBALS['connectDb'], $query);

    if($_SESSION['utilisateur']['type_compte']=="ENSEIGNANT") {

        $query = "SELECT ID, NOM, PRENOM, ENLIGNE_DEPUIS FROM etudiant WHERE FILIERE=".$_SESSION['utilisateur']['classe']['FILIERE']." ORDER BY ENLIGNE_DEPUIS DESC";
        $results = mysqli_query($GLOBALS['connectDb'], $query);

        if (mysqli_num_rows($results) > 0) {
			echo '<ul style="list-style: none; padding: 5px;">';
            while( $row = mysqli_fetch_assoc($results)){
                echo '<li><h2><a href="?classe='.$_SESSION['utilisateur']['classe']['ID'].'&etudiant='.$row['ID'].'"';
                if(time()-strtotime($row['ENLIGNE_DEPUIS'])<=1) { 
					echo ' style="color:green;"><i class="fa fa-user-check"></i> '; 
				} else {
					echo ' style="color:grey;"><i class="fa fa-user-times"></i> ';
				}
                echo $row['NOM']." "  .$row['PRENOM'].'';
                echo '</a></h2></li>';
            }
			echo '</ul>';
        }
    } else {     
        $query = "SELECT ID, MODULE, ENSEIGNANT FROM classe WHERE FILIERE=".$_SESSION['utilisateur']['classe']['ID'];
        $classe = mysqli_query($GLOBALS['connectDb'], $query);
        $enseignant = array();
        if (mysqli_num_rows($classe) > 0) {
            while( $res_classe = mysqli_fetch_assoc($classe)){
                $query = "SELECT ID, NOM, PRENOM, ENLIGNE_DEPUIS FROM enseignant WHERE ID=".$res_classe['ENSEIGNANT'];  
                $id_enseignant = $res_classe['ENSEIGNANT'];
                unset($res_classe['ENSEIGNANT']);
                $enseignant[$id_enseignant]['classe'][] = $res_classe;
                if(!isset($enseignant[$id_enseignant]['info'])) {
                    $query = "SELECT ID, NOM, PRENOM, ENLIGNE_DEPUIS FROM enseignant WHERE ID=".$id_enseignant;
                    $results = mysqli_query($GLOBALS['connectDb'], $query);
                    $enseignant[$id_enseignant]['info'] = mysqli_fetch_assoc($results);
                }
            }
        }
        foreach($enseignant as $id => $module) {
            echo '<div  class="contact"><h1';
                if(time()-strtotime($enseignant[$id]["info"]['ENLIGNE_DEPUIS'])<=1) { echo ' style="color:green;"><i class="fa fa-user-check"></i> '; } else { echo ' style="color:grey;"><i class="fa fa-user-times"></i> '; }
                echo $enseignant[$id]["info"]['NOM']." "  .$enseignant[$id]["info"]['PRENOM'].'</h1><ul style="list-style: none; padding: 0">';
                for($i=0;$i<count($enseignant[$id]["classe"]);$i++) echo '<li><a class="module my-0 py-0 pl-3" href="?classe='.$enseignant[$id]["classe"][$i]['ID'].'"><i class="fa fa-book"></i> '.$_SESSION['nom_module'][$enseignant[$id]["classe"][$i]['MODULE']].'</a></li>';
            echo '</ul></div>';
        }
        
    }
?>