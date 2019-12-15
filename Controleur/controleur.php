<?php

require_once('Modele/modele.php');
require_once('Vue/vue.php');

	function CtlAccueil(){
		afficherAccueil();
	}

	function CtlTesterConnexion($login,$mdp,$grade){
		if(!empty($login) && !empty($mdp)){
			if(testConnexion($login,$mdp,$grade)){
				afficherPage($grade);
			}
			else{
				throw new Exception('Login ou mot de passe incorrect. Veulliez réessayer.');
			}
		}
		else{
			throw new Exception('champ login ou mot de passe vide');
		}
	}

	function CtlNouveauPatient($nom,$prenom,$adresse,$tel,$dateNaissance,$depnaissance,$nSecu){
		if(!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($tel) && !empty($dateNaissance) && !empty($depnaissance) && !empty($nSecu)){
			ajouterPatient();
		}
		else{
			throw new Exception('Un des champs est vide');
		}
	}

	function CtlAfficherSynthese($nSecu){
		if(!empty($nSecu)){
			$infoPatient = synthesePatient($nSecu);
			if ($infoPatient==null){
				throw new Exception('Numéro incorrect');
			}
			afficherSynthese($infoPatient);
		}
		else{
			throw new Exception('champ vide');
		}
	}

	function CtlDepot($nSecu,$montant){
		if(!empty($nSecu) && !empty($montant)){
			ajouterMontant($nSecu,$montant);
		}
	}

	function CtlAfficherRendezVousNonPayes($nSecu){
		if(!empty($nSecu)){
			$rdvNonPayes=rdvNonPayes($nSecu);
			if ($rdvNonPayes==null){
				throw new Exception('Numéro incorrect');
			}
			afficherRdvNonPayes($rdvNonPayes);
		}
	}	

	function CtlBloquerCreneau(){

	}

	function CtlAjouterEmploye($login,$mdp,$grade){
		if (!empty($login) && !empty($mdp)){
			ajouterEmploye($login,$mdp,$grade);
		}


	}

	function CtlAfficherEmployes($login,$grade){
		if (!empty($login)){
			$login=checkLogin($login);
			if ($login==null){
				throw new Exception('login incorrect');
			}
			afficherEmployes($login);

		}
	}

	function CtlModifierEmploye($loginRecherche,$login,$mdp,$grade){
		if (!empty($login) && !empty($mdp)){
			modifierEmploye($loginRecherche,$login,$mdp,$grade);
		}
	}

	function CtlCreerMotif($nom,$consigne,$piece,$prix){
		if (!empty($nom) && !empty($consigne) && !empty($piece) && !empty($prix)){
			creerMotif($nom,$consigne,$piece,$prix);
		}
	}

	function CtlModifierMotif($nom,$newNom,$newConsigne,$nouvellePiece,$nouveauPrix){
		if (!empty($nom) && (!empty($newNom) || !empty($newConsigne) || !empty($nouvellePiece) || !empty($nouveauPrix))){
			$checkedNom=checkNomMotif($nom);
			if($nom==null){
				throw new Exception('Nom du motif incorrect');
			}
			else{
				modifierMotif($newNom,$newConsigne,$nouvellePiece,$nouveauPrix);
			}
		}
	}

	function CtlSupprimerMotif($nom){
		if (!empty($nom)){
			supprimerMotif($nom);
		}
	}

	function CtlAfficherMotifs(){
		$motifs=getMotifs();
		if ($motifs==null){
			throw new Exception('Aucun motif disponible');
		}
		else{
			afficherMotifs($motifs);
		}
	}

	function CtlCreerMedecin($nom,$prenom,$spe){
		if (!empty($nom) && !empty($prenom) && !empty($spe)){
			creerMedecin($nom,$prenom,$spe);
		}
	}

	function CtlAfficherMedecins(){
		$medecins=getMedecins();
		if ($medecins==null){
			throw new Exception('Aucun médecins enregistrés');
		}
		else{
			afficherMedecins($medecins);
		}
	}

	function CtlSupprimerMedecin($id){
		supprimerMedecin($id);
	}


	function CtlErreur($msg){
		afficherErreur($msg);
	}