<?php

require_once('Modele/modele.php');
require_once('Vue/vue.php');


	function CtlTesterConnexion($login,$mdp,$grade){
		if(!empty($login) &&!empty($mdp)){
			if(testConnexion($login,$mdp,$grade)){
				afficherPage($grade);
			}
			else{
				throw new Exception('Login ou mot de passe incorrect. Veulliez réessayer.');
			}
		}
	}

	function CtlNouveauPatient($nom,$prenom,$adresse,$tel,$dateNaissance,$depnaissance,$nSecu){
		if(!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($tel) && !empty($dateNaissance) && !empty($depnaissance) && !empty($nSecu)){
			ajouterPatient();
		}
	}

	function CtlAfficherSynthese($nSecu){
		if(!empty($nSecu)){
			$infoPatient = synthesePatient($nSecu);
			afficherSynthese($infoPatient);
		}
	}

	function CtlDepot($nSecu,$montant){
		if(!empty($nSecu) && !empty($montant)){
			ajouterMontant($nSecu,$montant);
		}
	}

	function CtlAfficherRendezVousNonPayes($nSecu){
		if(!empty($nSecu)){
			afficherRdvNonPayes($nSecu);
		}
	}	

	function CtlBloquerCreneau(){

	}

	function CtlAjouterEmploye(){

	}

	function CtlAfficherEmployes(){

	}

	function CtlModifierEmployes(){

	}

	function CtlAjouterMotif(){

	}

	function CtlModifierMotif(){

	}

	function CtlSupprimerMotif(){

	}

	function CtlAfficherMotifs(){

	}

	function CtlAjouterMedecin(){

	}

	function CtlAfficherMedecins(){

	}

	function CtlSupprimerMedecin(){

	}


	function CtlErreur($msg){
		CtlAfficherErreur($msg);
	}

