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

	function CtlNouveauPatient($nom,$prenom,$adresse,$tel,$dateNaissance,$depNaissance,$nSecu){
		if(!empty($nom) && !empty($prenom) && !empty($adresse) && !empty($tel) && !empty($dateNaissance) && !empty($depNaissance) && !empty($nSecu)){
			if(nssLibre($nSecu)){
					ajouterPatient($nom,$prenom,$adresse,$tel,$dateNaissance,$depNaissance,$nSecu);
					afficherPage('Agent');
				}
			else{
				afficherPage('Agent','Ce patient existe déjà.');
			}
		}
		else{
			afficherPage('Agent','Un des champs est vide');
		}
	}

	function CtlAfficherSynthese($nSecu){
		
		if(!empty($nSecu)){
			if (!nssLibre($nSecu)){
				$infoPatient = getSynthesePatient($nSecu);
				afficherSynthese($infoPatient);	
			}
			else{
				afficherPage('Agent','Ce numero de sécurité sociale n\'est pas enregistré');
			}
		}
		else{
			afficherPage('Agent','Le champ est vide');
		}
		
	}

	function CtlAfficherMotifsAgent(){
		$motifs = getMotifs();
		afficherMotifs($motifs);
	}

	function CtlDepot($nSecu,$montant){
		if(!empty($nSecu) && !empty($montant)){
			ajouterMontant($nSecu,$montant);
			afficherPage('Agent');
		}
		else{
			afficherPage('Agent', 'Un des champs est vide');
		}
	}

	function CtlAfficherRendezVousNonPayes($nSecu){
		if(!empty($nSecu)){
			if(!nssLibre($nSecu)){
				$rdvNonPayes=getRdvNonPayes($nSecu);
				afficherRdvNonPayes($rdvNonPayes);
			}
			else{
				afficherPage('Agent','Ce numero de sécurité social n\'est pas enregistré');
			}
		}
		else{
			afficherPage('Agent','Le champ est vide');
		}
	}	

	function CtlBloquerCreneau(){
		foreach ($date as $key => $value) {
			//	echo $value " - " $heure[$key];
			//ajouterCrenea u($value, $heure[$key]);
			

	 }
	}

	function CtlCreerEmploye($login,$mdp,$grade){
		if (!empty($login) && !empty($mdp)){
			creerEmploye($login,$mdp,$grade);
			afficherPage("Directeur", "Un nouveau employé a été crée");
		}
		else{
			afficherPage('Directeur','ERREUR : un champ est vide');
		}

	}

	function CtlAfficherEmployes($grade){
		$listeEmployes=getEmployes($grade);
		if ($listeEmployes==null){
			afficherPage('Directeur','ERREUR : aucun employé n\'existe dans votre base de donnée');
		}
		else{
			afficherEmployes($listeEmployes,$grade);
		}
	}

	function CtlModifierEmploye($loginRecherche,$login,$mdp,$grade){
		if (!empty($login) && !empty($mdp)){
			$checkedLoginRecherche=checkLogin($loginRecherche,$grade);
			if ($checkedLoginRecherche!=null){
				modifierEmploye($loginRecherche,$login,$mdp,$grade);
				afficherPage('Directeur');
			}
			else{
				afficherPage('Directeur',"ERREUR : Le login rechercher n'existe pas dans la bdd");
			}
		}
		else{
			afficherPage('Directeur','ERREUR : un champ est vide');
		}
	}

	function CtlCreerMotif($nom,$consigne,$piece,$prix){
		if (!empty($nom) && !empty($consigne) && !empty($piece) && !empty($prix)){
			$checkedNom=checkNomMotif($nom);
			if ($checkedNom==null){
				creerMotif($nom,$consigne,$piece,$prix);
				afficherPage("Directeur", "Un nouveau motif a été crée");
			}
			else{
				afficherPage('Directeur',"ERREUR : Motif déjà existant, veuillez utiliser la fonction modifier ou supprimer motif");
			}
		}
		else{
			afficherPage('Directeur','ERREUR : un des champs vide');
		}
	}

	function CtlModifierMotif($newNom,$newConsigne,$nouvellePiece,$nouveauPrix){
		if (!empty($newNom) && !empty($newConsigne) && !empty($nouvellePiece) && !empty($nouveauPrix)){
			$motif=getMotif($nom);
			modifierMotif($newNom,$newConsigne,$nouvellePiece,$nouveauPrix);
		}
		else{
			afficherPage('Directeur','ERREUR : un des champs vide');
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
			afficherPage('Directeur','ERREUR : Aucun motif disponible');
		}
		else{
			afficherMotifsDirecteur($motifs);
		}
	}

	function CtlCreerMedecin($login,$mdp,$nom,$prenom,$spe){
		if (!empty($login) && !empty($mdp) && !empty($nom) && !empty($prenom) && !empty($spe)){
			creerMedecin($login,$mdp,$nom,$prenom,$spe);
			AfficherPage("Directeur", 'Un nouveau médecin a été créé');
		}
		else{
			afficherPage('Directeur','ERREUR : un des champs vide');
		}
	}
	
	function CtlAfficherMedecins(){
		$medecins=getEmployes("Medecin");
		if ($medecins==null){
			afficherPage('Directeur','ERREUR : Aucun médecins enregistrés');
		}
		else{
			afficherMedecins($medecins);
		}
	}

	function CtlSupprimerMedecin($id){
		if (!empty($id)){
			$checkedId=checkId($id);
			if ($checkedId!=null){
				supprimerMedecin($id);
				afficherPage('Directeur',"Un médécin vient d'être supprimé");			
			}
			else{
				afficherPage('Directeur',"ERREUR : Id incorrect, médecin non trouvé");
			}
		}
	}


	function CtlErreur($msg){
		afficherErreur($msg);
	}