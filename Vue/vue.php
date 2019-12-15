<?php

	function afficherAccueil(){
		require_once('gabaritAccueil.php');
	}

	function afficherPage($grade , $exceptionLevee=''){
		if($grade=='Agent'){
			require_once('gabaritAgents.php');
		}
		else if($grade=='Medecin'){
			require_once('gabaritMedecins.php');
		}
		else if($grade=='Directeur'){
			require_once('gabaritDirecteur.php');
		}
		else{
			require_once('gabaritAccueil.php');
		}
	}

	function afficherSynthese($infoPatient){
		$contenuSynthese = '<p>Numero de sécurité social : '.$infoPatient[0][0].'<br/>Nom : '.$infoPatient[0][1].'<br/>Prenom : '.$infoPatient[0][2].'<br/>Adresse : '.$infoPatient[0][3].'<br/> Numero de téléphone : +33'.$infoPatient[0][4].'<br/> Date de Naissance : '.$infoPatient[0][5].'<br/>Departement de naissance : '.$infoPatient[0][6].'<br/> Solde sur le compte du patient : '.$infoPatient[0][7].'</p>';
		require_once('gabaritAgents.php');
	}

	function afficherErreur($msg){
 		echo $msg;
	}