<?php

require_once('Controleur/controleur.php');

try{
	if (isset($_POST["seConnecter"])) {
		
		$login = $_POST["login"];
		$mdp = $_POST['password'];
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
		
		CtlAjouterEmploye();
	}

	else if (isset($_POST["rechercherEmploye"])) {

		CtlAfficherEmployes();
	}

	else if (isset($_POST["modifierEmploye"])) {

		CtlModifierEmployes();
	}

	else if (isset($_POST["creer_motif"])) {

		CtlAjouterMotif();
	}

	else if (isset($_POST["modifierMotif"])) {

		CtlModifierMotif();
	}

	else if (isset($_POST["supprimerMotif"])) {

		CtlSupprimerMotif();
	}

	else if (isset($_POST["afficherMotifs"])) {

		CtlAfficherMotifs();
	}

	else if (isset($_POST["creerMedecin"])) {

		CtlAjouterMedecin();
	}

	else if (isset($_POST["afficherMedecins"])) {

		CtlAfficherMedecins();
	}

	else if (isset($_POST["supprimerMedecin"])) {

		CtlSupprimerMedecin();
	}


}
catch(Exception $e){

		$msg=$e->getMessage();
		CtlErreur($msg);

}