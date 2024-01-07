<section class="sections">
<?php
	include_once('users.php');
	echo '<section class="chat-area" style="width:60%;"><section><i class="fa fa-users img"></i><h1>';
		if($_SESSION['utilisateur']['type_compte'] == "ETUDIANT") {
			if(isset($_GET['classe']) && isset($_SESSION['nom_module'][$_GET['classe']])) echo $_SESSION['nom_module'][$_GET['classe']]; 
		} else {
			if(isset($_GET['etudiant'])) {
				if($_GET['etudiant']!="0") echo $_SESSION['utilisateur']['classes'][$_GET['classe']]['ETUDIANT'][$_GET['etudiant']]['NOM'].' '.$_SESSION['utilisateur']['classes'][$_GET['classe']]['ETUDIANT'][$_GET['etudiant']]['PRENOM'].' @ ';
			}
			echo '<a style="text-decoration:none;" href="?classe='.$_GET['classe'].'">'.$_SESSION['utilisateur']['classe']['NOM'].'</a>';
		}
	echo '</h1></section><div onmouseover="clearInterval(msgTimer);" onmouseout="msgTimer=setInterval(refreshMsg,1000)" class="chat-box" id="msg">';
	include_once('message.php');
	echo '</div></section>';
	
?></section>
<section class="sections" style="padding:10px;background:#7caeba; position:relative; top: -30px;">
<div class="typing-area" style="border:5px solid #333; border-radius: 5px; background:#333;"><input style="padding-left:10px;" type="text" id="messageTexte"><button type="button" style="padding: 5px; border:none;" onclick="envoiMsg();" onkeypress="enterKeyPressed(event)"><i class="fa fa-paper-plane"></i></button></div>
</section>
	<script>
	$('#messageTexte').on('keypress',function(e) {
		if(e.which == 13) {
			envoiMsg();
		}
	});
	
	function envoiMsg() {
		if($('#messageTexte').val()!='') $.post( <?php echo '"./?'.$_SERVER['QUERY_STRING'].'"'; ?>, { message: $('#messageTexte').val() } ); 
		$('#messageTexte').val("");
	}
</script>