function ajouter_zone() {
	var nb_creneau = window.document.forms[0].elements['nb_creneau'].value;
	var chaine = "";

	for (i = 0; i<nb_creneau; i++){
		chaine = chaine + '</br><label>Créneau '+eval(i+1)+' : </label><input type="text" name="'+i+'"></br>';
	}
	chaine = chaine + '</br><input type="submit" name="ajouter_creneau" value="Ajouter créneaux">';
	document.getElementById('ajouter').innerHTML=chaine;
}