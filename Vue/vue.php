<?php

	function afficherPage($grade){
		if($grade=='Agent'){
			require_once('gabaritAgent.php');
		}
		else if($grade=='Medecin'){
			require_once('gabaritMedecin.php');
		}
		else if($grade=='Directeur'){
			require_once('gabaritDirecteur.php');
		}
		else{
			require_once('gabaritAccueil.php');
		}
	}