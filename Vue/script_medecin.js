
// fonction affiche zones de texte en fonction du nombre de créneaux choisi


function ajouter_zone() {
	var nb_creneau = window.document.forms[0].elements['nb_creneau'].value;
	var chaine = "";
	var today = new Date();
	var minimum_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
	
	for (i = 0; i<nb_creneau; i++){
		chaine = chaine + '</br><label>Créneau '+eval(i+1)+' : </label><input type="date" min='+minimum_date+' name="date['+i+']" required>&nbsp;<label>Heure : </label><input type="number" min="0" max="23" name="hour['+i+']" required></br>';
	}
	if (nb_creneau==0 || nb_creneau<0 || isNaN(nb_creneau)){
		chaine = chaine;
	}
	else{
		chaine = chaine + '</br><input type="submit" name="ajouterCreneau" value="Ajouter créneaux">';
	}
	
	document.getElementById('ajouter').innerHTML=chaine;
}