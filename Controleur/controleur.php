<?php

require_once('Modele/modele.php');
require_once('Vue/vue.php');

	function CtlAccueil(){																									//Redirige vers la page d'accueil via afficherAccueil
		afficherAccueil();
	}

	function CtlTesterConnexion($login,$mdp,$grade){																		//Test si les champs sont vide puis si les logins/mdp correspondent et affiche 
																															//des messages d'erreurs sinon.
		if(!empty($login) && !empty($mdp)){
			if(testConnexion($login,$mdp,$grade)){
				afficherPage($grade);
			}
			else{
				afficherErreurAccueil('Login ou mot de passe incorrect. Veulliez réessayer.');
			}
		}
		else{
			afficherErreurAccueil('champ login ou mot de passe vide');
		}
	}

	function CtlNouveauPatient($nom,$prenom,$pays,$adresse,$tel,$dateNaissance,$depNaissance,$nSecu){
		if(!empty($nom) && !empty($prenom) && !empty($pays) && !empty($adresse) && !empty($tel) && !empty($dateNaissance) && !empty($depNaissance) && !empty($nSecu)){
			if(nssLibre($nSecu)){
					ajouterPatient($nom,$prenom,$pays,$adresse,$tel,$dateNaissance,$depNaissance,$nSecu);
					afficherPage('Agent','Le patient a bien été enregistré.');
				}
			else{
				afficherPage('Agent','Ce patient existe déjà.');
			}
		}
		else{
			afficherPage('Agent','Un des champs est vide');
		}
	}

	function CtlAfficherFormProfilPatient($nSecu){
		if(!empty($nSecu)){
			if(!nssLibre($nSecu)){
				$infoAModifier = getSynthesePatient($nSecu);
				afficherFormModifPatient($infoAModifier);
			}
			else{
				afficherPage('Agent','Ce n\'est pas enregistré.');
			}
		}
	}

	function CtlModifPatient($nSecu,$nom,$prenom,$pays,$adresse,$numTel,$dateNaissance,$depNaissance){
		if(!empty($nom) && !empty($prenom) && !empty($pays) && !empty($adresse) && !empty($numTel) && !empty($dateNaissance) && !empty($depNaissance)){
			if(!nssLibre($nSecu)){
					modifierPatient($nom,$prenom,$pays,$adresse,$numTel,$dateNaissance,$depNaissance,$nSecu);
					afficherPage('Agent','Le patient à bien été modifié.');
				}
			else{
				afficherPage('Agent','Ce patient n\'est pas enregistré.');
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
			$ancienMontant=getSolde($nSecu);
			ajouterMontant($nSecu,$montant);
			$nvMontant=getSolde($nSecu);
			afficherMontants($ancienMontant,$nvMontant);
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

	function CtlReglerRdv($idRdv,$nSecu,$nomMotif){
		$montant=getSolde($nSecu);
		$prix=getPrix($nomMotif);
		var_dump($prix[0][0]);
		if((int)$montant[0][0]>(int)$prix[0][0]){
			debiter($nSecu,$prix[0][0]);
			payementEffectué($idRdv);
			afficherPage('Agent','Le rendez-vous à bien été réglé.');
		}
		else{
			afficherPage('Agent','Solde insuffisant.');
		}
	}

	function CtlBloquerCreneau(){
		foreach ($date as $key => $value) {
			ajouterCreneau($value, $heure[$key]);
			

	 }
	}

	function CtlAjouterEmploye($login,$mdp,$grade){
		if (!empty($login) && !empty($mdp)){
			ajouterEmploye($login,$mdp,$grade);
		}
		else{
			throw new Exception('un champ est vide');
		}

	}

	function CtlAfficherEmployes($login,$grade){
		if (!empty($login)){
			$login=checkLogin($login,$grade);
			if ($login==null){
				throw new Exception('login incorrect');
			}
			afficherEmployes($login);

		}
		else{
			throw new Exception('un champ est vide');
		}
	}

	function CtlModifierEmploye($loginRecherche,$login,$mdp,$grade){
		if (!empty($login) && !empty($mdp)){
			modifierEmploye($loginRecherche,$login,$mdp,$grade);
		}
		else{
			throw new Exception('un champ est vide');
		}
	}

	function CtlCreerMotif($nom,$consigne,$piece,$prix){
		if (!empty($nom) && !empty($consigne) && !empty($piece) && !empty($prix)){
			creerMotif($nom,$consigne,$piece,$prix);
		}
		else{
			throw new Exception('un des champs vide');
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
		else{
			throw new Exception('un des champs vide');
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
		else{
			throw new Exception('un des champs vide');
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
		echo "Medecin supprimé";
		afficherPage('Directeur');
	}


	function CtlErreur($msg){
		afficherErreur($msg);
	}