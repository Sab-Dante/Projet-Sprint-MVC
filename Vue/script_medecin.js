

// fonction affiche zones de texte en fonction du nombre de créneaux choisi

function ajouter_zone() {
	var nb_creneau = window.document.forms[0].elements['nb_creneau'].value;
	var chaine = "";

	for (i = 0; i<nb_creneau; i++){
		chaine = chaine + '</br><label>Créneau '+eval(i+1)+' : </label><input type="text" name="'+i+'"></br>';
	}
	if (nb_creneau==0 || nb_creneau<0 || isNaN(nb_creneau)){
		chaine = chaine;
	}
	else{
		chaine = chaine + '</br><input type="submit" name="ajouter_creneau" value="Ajouter créneaux">';
	}
	
	document.getElementById('ajouter').innerHTML=chaine;
}