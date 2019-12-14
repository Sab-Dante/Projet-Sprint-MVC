<?php

require_once('Controleur/controleur.php');

try{
	if (isset($_POST["seConnecter"])) {
		CtlTesterConnexion();
	}
	else if (isset($_POST["envoyerNvPatient"])) {
		CtlNouveauPatient();
	}
	else if (isset($_POST["envoyerSynthse"])) {
		CtlAfficherSynthese();
	}
	else if (isset($_POST["envoyerMontantDepot"])) {
		CtlDepot();
	}
	else if (isset($_POST["visualiserRendezVous"])) {
		CtlAfficherRendezVousNonPayes();	
	}
	else if (isset($_POST["ajouter_creneau"])) {
		CtlBloquerCreneau();
	}


}


catch(Exception $e){

$msg=$e->getMessage();
ctlErreur($msg);

}