<?php

require_once('Controleur/controleur.php');

try{
	if (isset($_POST["seConnecter"])) { 															//On se situe sur la page d'accueil et on relève les entrées du formulaire
		$login = $_POST["login"];
		$mdp = $_POST['mdp'];
		$grade = $_POST['grade'];
		CtlTesterConnexion($login,$mdp,$grade);
	}
	
	else if (isset($_POST["envoyerNvPatient"])) {													//On se situe dans la page Agent dans le formulaire de création de patient
																									//On relève les différentes informations du formulaire
		$nom = $_POST['nomPatient'];
		$prenom = $_POST['prenomPatient'];
		if(isset($_POST['pays'])){
			$pays = $_POST['pays'];
		}
		else{
			$pays='France';
		}
		$adresse = $_POST['adresse'];
		$tel = $_POST['numTel'];
		$dateNaissance = $_POST['dateNaissance'];
		$depNaissance = $_POST['depNaissance'];
		$nSecu = $_POST['numSecuriteSociale'];
		CtlNouveauPatient($nom,$prenom,$pays,$adresse,$tel,$dateNaissance,$depNaissance,$nSecu);
	}

	else if (isset($_POST['accederPatient'])){
		$nSecu = $_POST['numSecuriteSociale'];
		CtlAfficherFormProfilPatient($nSecu);
		}

	else if (isset($_POST['modifierPatient'])){
		$nSecu = $_POST['nSecu'];
		$nom = $_POST['nom'];
		$pays = $_POST['pays'];
		$prenom = $_POST['prenom'];
		$pays = $_POST['pays'];
		$adresse = $_POST['adresse'];
		$numTel = $_POST['numTel'];
		$dateNaissance = $_POST['dateNaissance'];
		$depnaissance = $_POST['depNaissance'];
		CtlModifPatient($nSecu,$nom,$prenom,$pays,$adresse,$numTel,$dateNaissance,$depnaissance);
	}

	else if (isset($_POST["envoyerSynthese"])) {													//On se situe dans la page Agent dans le formulaire de consultation de synthèse
																									//On relève le code de sécurité social entré
		$nSecu = $_POST['codeSecuriteSociale'];
		CtlAfficherSynthese($nSecu);
	}

	else if (isset($_POST["envoyerMontantDepot"])) {												//On se situe dans la page Agent dans le formulaire de dépot sur le compte d'un client
																									//On relève son code de sécurité social et le montant à ajouter
		$nSecu = $_POST['codeSecuriteSociale'];
		$montant = intval($_POST['montantDepot']);
		CtlDepot($nSecu,$montant);
	}

	else if (isset($_POST["visualiserRendezVousNonPayes"])) {										//On se situe dans la page agent dans le dernier fomulaire(pour visualisés les rendez-vous non payés)
																									//On relève le code de sécurité social
		$nSecu = $_POST['codeSecuriteSociale'];
		CtlAfficherRendezVousNonPayes($nSecu);	
	}

	else if (isset($_POST['reglerRdv'])){
		$nomMotif=$_POST['motif'];
		$idRdv=$_POST['idRdvNonPaye'];
		$nSecu=$_POST['nssRdvNonPaye'];
		CtlReglerRdv($idRdv,$nSecu,$nomMotif);
	}

	else if (isset($_POST["ajouterCreneau"])) {
		$date = $_POST['date'];
		$heure = $_POST['hour'];
		CtlBloquerCreneau($date, $hour);		
	}

	else if (isset($_POST["creerEmploye"])) {
		$login=$_POST['login'];
		$mdp=$_POST['mdp'];
		CtlCreerEmploye($login,$mdp,"Agent");
	}

	else if (isset($_POST["rechercherEmployes"])) {
		$grade=$_POST['grade'];
		CtlAfficherEmployes($grade);
	}

	else if (isset($_POST["modifierEmploye"])) {
		$loginRecherche=$_POST["loginRecherche"];
		$login=$_POST["modifLogin"];
		$mdp=$_POST["modifMdp"];
		$grade=$_POST["grade"];
		CtlModifierEmploye($loginRecherche,$login,$mdp,$grade);
	}

	else if (isset($_POST["creerMotif"])) {
		$nom=$_POST['nomMotif'];
		$consigne=$_POST['consigne'];
		$piece=$_POST['piece'];
		$prix=$_POST['prix'];
		CtlCreerMotif($nom,$consigne,$piece,$prix);
	}

	else if (isset($_POST["modifierMotif"])) {
		$nom=$_POST['nomModif'];
		$newNom=$_POST['nouveauNom'];
		$newConsigne=$_POST['nouvelleConsigne'];
		$nouvellePiece=$_POST['nouvellePiece'];
		$nouveauPrix=$_POST['nouveauPrix'];

		CtlModifierMotif($nom,$newNom,$newConsigne,$nouvellePiece,$nouveauPrix);
	}

	else if (isset($_POST["supprimerMotif"])) {
		$nom=$_POST['motifSupprimer'];
		CtlSupprimerMotif($nom);
	}

	else if (isset($_POST["afficherMotifs"])) {
		CtlAfficherMotifs();
	}

	else if (isset($_POST["creerMedecin"])) {
		$login=$_POST['loginMedecin'];
		$mdp=$_POST['mdpMedecin'];
		$nom=$_POST['nomMedecin'];
		$prenom=$_POST['prenomMedecin'];
		$spe=$_POST['specialite'];
		CtlCreerMedecin($login,$mdp,$nom,$prenom,$spe);
	}

	else if (isset($_POST["afficherMedecins"])) {

		CtlAfficherMedecins();
	}

	else if (isset($_POST["supprimerMedecin"])) {
		$id=$_POST['idMedecin'];
		CtlSupprimerMedecin($id);
	}
	else{																																//Si aucun bouton n'est cliqué on affiche la page de connexion
		CtlAccueil();
	}


}
catch(Exception $e){																													//Redirection d'erreurs

		$msg=$e->getMessage();
		CtlErreur($msg);

}