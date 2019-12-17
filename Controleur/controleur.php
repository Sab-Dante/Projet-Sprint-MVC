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

	);
			
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

	function CtlModifierMotif($nom){
		if (!empty($nom)){
			$motif=getMotif($nom);
			if ($motif!=null){
				afficherPageModifMotif($motif);
			}
			else{
				afficherPage("Directeur","nom de motif incorrect");
			}
		}
		else{
			afficherPage('Directeur','ERREUR : un des champs vide');
		}
	}

	function CtlValiderModif($nom,$newNom,$newConsigne,$nouvellePiece,$nouveauPrix){
		if (!empty($nom) && !empty($newNom) && !empty($newConsigne) && !empty($nouvellePiece) && !empty($nouveauPrix)){
			$checkedNom=checkNomMotif($nom);
			if ($checkedNom!=null){
				validerModif($nom,$newNom,$newConsigne,$nouvellePiece,$nouveauPrix);
				afficherPage("Directeur","Motif modifié");
			}
			else{
				afficherPage("Directeur","nom motif incorrect");
			}

		}
		else{
			afficherPage("Directeur","Un des champs est vide");
		}


	}

	function CtlSupprimerMotif($nom){
		if (!empty($nom)){
			$checkedNom=checkedNomMotif($nom);
			if ($checkedNom!=null){
				supprimerMotif($nom);
				afficherPage("Directeur","Un motif a bien été supprimé");
			}
			else{
				afficherPage("Directeur","Le nom du motif entré n'existe pas");
			}
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