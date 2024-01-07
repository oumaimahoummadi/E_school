<?php
    $GLOBALS['connectDb'] = mysqli_connect('localhost','root','','enseignement_a_distance');
    if(isset($_SESSION['utilisateur'])) {
        if($_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT" && !isset($_SESSION['utilisateur']['classes'])) {
            $query = "SELECT ID, FILIERE, MODULE, CODE_MODULE FROM CLASSE WHERE ENSEIGNANT=".$_SESSION['utilisateur']['ID'];
            $results = mysqli_query($GLOBALS['connectDb'], $query);
            $_SESSION['utilisateur']['classes'] = array();
            for($i=0; $i<mysqli_num_rows($results); $i++)  {
                $classe = mysqli_fetch_assoc($results);
                $_SESSION['utilisateur']['classes'][$classe['ID']] = $classe;
                $_SESSION['utilisateur']['classes'][$classe['ID']]['NOM'] = $_SESSION['nom_module'][$classe['CODE_MODULE']].' - '.$_SESSION['nom_filiere'][$classe['FILIERE']]['ABREVIATION'];
				$query = "SELECT ID, NOM, PRENOM FROM ETUDIANT WHERE FILIERE=".$classe['FILIERE'];
				$res_etudiant = mysqli_query($GLOBALS['connectDb'], $query);
				for($j=0; $j<mysqli_num_rows($res_etudiant); $j++)  {
					$etudiant = mysqli_fetch_assoc($res_etudiant);
					$_SESSION['utilisateur']['classes'][$classe['ID']]['ETUDIANT'][$etudiant['ID']] = $etudiant;
				}
            }
        }
    }

?>
<header>
    <div class="container" >
        <div class="row">  
            <!-- bars icone -->
            <i id="cursors" class="icon fa fa-bars fa-2x" onclick='$("#navul").slideToggle("slow");'></i>
            <?php include('nav.php'); ?>
		</div>
    </div>   
</header>