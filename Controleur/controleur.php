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

	function CtlVerifRDV($nss, $login, $specialite, $date, $hour){
		
		if(nssLibre($nss)){
			afficherPage('Agent','Patient inconnu, veuillez l\'inscrire');
		}
		else{
			$spe_medecin = specialiteMedecin($login);
			if($spe_medecin[0] != $specialite) {
				afficherPage('Agent','Le medecin n\'a pas cette spécialité');

			}
			else{

				if ((checkCreneau($login, $date, $hour)[0] == 0) && (checkRDV($nss, $date, $hour)[0] == 0)){
					$tab_motif = recupMotif();
					listeMotif($tab_motif);	
				}
				else{
					afficherPage('Agent','Le créneau est déjà pris');
				}
			}
		}


	}
	function CtlPriseRDV($nss, $login, $specialite, $date, $hour, $motif){
		ajouterRDV($nss, $login, $specialite,$date, $hour, $motif);
		afficherPage('Agent','Ajout réussi !');
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

	//Bloquer les créneaux pour le médecin

	function CtlBloquerCreneau($login, $date, $hour){
		if(checkMedecins($login) != null){
			foreach ($date as $key => $value) {
				if (checkCreneau($login,$value, $hour[$key])[0] == 0){
					ajouterCreneau($login, $value, $hour[$key]);
				}
				else{
					afficherPage('Medecin','Le créneau est déjà pris');
					
				}
			}
		}
		else{
			afficherPage('Medecin','Le médecin n\'existe pas');
			
		}
		afficherPage('Medecin');
		
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