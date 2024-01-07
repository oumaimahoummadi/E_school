function compteARebour(id, date) {
	var echeance = new Date(date).getTime();
	//alert(echeance);
	compteur = setInterval(function() {
	  var now = new Date().getTime();
	  var diff = echeance - now;
	  var j = Math.floor(diff / (1000 * 60 * 60 * 24));
	  var h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  h = (h<10)?"0"+h:h;
	  var m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
	  m = (m<10)?"0"+m:m;
	  var s = Math.floor((diff % (1000 * 60)) / 1000);
	  s = (s<10)?"0"+s:s;
	  $("#echeance_"+id).html(+j + " J " + h + ":" + m + ":" + s);
	  if (diff < 0) {
		clearInterval(compteur);
		$("#echeance_"+id).html("FINIE");
	  }
	}, 1000);
	return compteur;
}

function editEcheance(devoir, date, compteur) {
	var form = '<form method="POST"><i class="fas fa-window-close"></i> <input type="date" name="edit_echeance" value="'+date+'"><input type="hidden" name="devoir" value="'+devoir+'"> <button type="submit"><i class="fas fa-save"></i></button></form>';
	if($("#echeance_"+devoir).html() != form) {
		$("#echeance_"+devoir).html(form);
		clearInterval(compteur);
		return null;
	}
}