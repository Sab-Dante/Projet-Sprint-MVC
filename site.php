<?php

require_once('Controleur/controleur.php');

try{
	if (isset($_POST["seConnecter"])) {
		$login = $_POST["login"];
		$mdp = $_POST['mdp'];
		$grade = $_POST['grade'];
		CtlTesterConnexion($login,$mdp,$grade);
	}
	
	else if (isset($_POST["envoyerNvPatient"])) {

		$nom = $_POST['nomPatient'];
		$prenom = $_POST['prenomPatient'];
		$adresse = $_POST['adresse'];
		$tel = $_POST['numTel'];
		$dateNaissance = $_POST['dateNaissance'];
		$depnaissance = $_POST['depNaissance'];
		$nSecu = $_POST['numSecuriteSociale'];

		CtlNouveauPatient($nom,$prenom,$adresse,$tel,$dateNaissance,$depnaissance,$nSecu);
	}

	else if (isset($_POST["envoyerSynthse"])) {

		$nSecu = $_POST['codeSecuriteSociale'];

		CtlAfficherSynthese($nSecu);
	}

	else if (isset($_POST["envoyerMontantDepot"])) {

		$nSecu = ['codeSecuriteSociale'];
		$montant = ['montantDepot'];

		CtlDepot($nSecu,$montant);
	}

	else if (isset($_POST["visualiserRendezVous"])) {

		$nSecu = $_POST['codeSecuriteSociale'];

		CtlAfficherRendezVousNonPayes($nSecu);	
	}

	else if (isset($_POST["ajouter_creneau"])) {

		CtlBloquerCreneau();
	}

	else if (isset($_POST["creerEmploye"])) {
		$login=$_POST['login'];
		$mdp=$_POST['mdp'];
		$grade=$_POST['grade'];
		CtlAjouterEmploye($login,$mdp,$grade);
	}

	else if (isset($_POST["rechercherEmploye"])) {
		$login=$_POST['loginRecherche'];
		$grade=$_POST['grade'];
		CtlAfficherEmployes($login,$grade);
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
		$nom=$_POST['nomMedecin'];
		$prenom=$_POST['prenomMedecin'];
		$spe=$_POST['specialite'];
		CtlCreerMedecin($nom,$prenom,$spe);
	}

	else if (isset($_POST["afficherMedecins"])) {

		CtlAfficherMedecins();
	}

	else if (isset($_POST["supprimerMedecin"])) {
		$id=$_POST['idMedecin'];
		CtlSupprimerMedecin($id);
	}
	else{
		CtlAccueil();
	}


}
catch(Exception $e){

		$msg=$e->getMessage();
		CtlErreur($msg);

}