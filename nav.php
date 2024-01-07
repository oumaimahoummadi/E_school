<nav class="col-lg-12 col-xs-12">
	<ul id="navul" class="nav-list">
		<li class="list"><a href="."><img src="img/este.png" style="height:75px;" alt='ESTE'/></a></li>
	<?php
		if(isset($_SESSION['utilisateur'])) {
			if($_SESSION['utilisateur']['type_compte'] == "ENSEIGNANT") {
				echo '<li class="list"><a href=".">Accueil</a></li>
				<li class="list"><a href="?cours">Mes cours</a></li>
				<li class="list">
					<div class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mes classes</a>
						<div class="dropdown-menu">';
						foreach($_SESSION['utilisateur']['classes'] as $i => $filiere) echo '<a class="dropdown-item" href="?classe='.$i.'">'.$_SESSION['utilisateur']['classes'][$i]['NOM'].'</a>'; 
						echo '</div>
					</div>
				</li>
			<li class="list"><a href="">Se déconnecter</a></li>';

			} elseif($_SESSION['utilisateur']['type_compte'] == "ETUDIANT") {

				echo '<li class="list"><a href=".">Accueil</a></li>';
				foreach($_SESSION['utilisateur']['classe']['modules'] as $i => $semestre) {
					echo '<li class="list">
						<div class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">S'.$i.'</a>
								<div class="dropdown-menu">';
									 for($j=0;$j<count($_SESSION['utilisateur']['classe']['modules'][$i]);$j++)
									 echo '<a class="dropdown-item" href="?cours='.$_SESSION['utilisateur']['classe']['modules'][$i][$j]['MODULE'].'">'.$_SESSION['utilisateur']['classe']['modules'][$i][$j]['NOM'].'</a>';
					echo '</div></div></li>';
				}
				
				echo '<li class="list"><a href="?classe">Ma classe</a></li>
				<li class="list"><a href="?logout">Se déconnecter</a></li>';
			}
		} else {
			echo '<li class="list"><a href="./#accueil">Accueil</a></li>
			<li class="list"><a href="./#About">A propos</a></li>
			<li class="list"><a href="./#filieres">Filières</a></li>
			<li class="list"><a href="./authentification.php">Se connecter</a></li>';
		}
	?>
	</ul>
</nav>