<?php

	function afficherAccueil(){
		require_once('gabaritAccueil.php');
	}

	function afficherPage($grade){
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

	function afficherErreur($msg){
 		echo $msg;
	}