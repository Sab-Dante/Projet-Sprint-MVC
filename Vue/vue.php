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

	function afficherMotifs($motifs){
		$listeMotifs='';
		if($motifs==null){
			$listeMotifs= '<p>Aucun motif n\'est disponible.</p>';
		}
		else{
			for($i=0 ; $i<count($motifs) ; $i+=1) {
				$listeMotifs.='<div class="motif"><p>Nom : '.$motifs[$i][0].'<br/> Consignes : '.$motifs[$i][1].'<br/> Pièces à fournir : '.$motifs[$i][2].'<br/>Prix :'.$motifs[$i][3].'€<br/></div>';
			}
		}
		require_once('gabaritAgents.php');
	}

	function afficherRdvNonPayes($rdvNonPayes){
		$rendezVousEnAttenteDePayement='';
		if($rdvNonPayes==null){
			$rendezVousEnAttenteDePayement='<p class="aucunRdvNonPaye">Aucun rendez-vous n\'est en attente de payement.</p>';
		}
		else{
			for($i=0 ; $i<count($rdvNonPayes) ; $i+=1) {
				$rendezVousEnAttenteDePayement.= '<p class="rdvNonPaye">Medecin : '.$rdvNonPayes[$i][2].'<br/> Specialité : '.$rdvNonPayes[$i][3].'<br/> date : '.$rdvNonPayes[$i][4].'<br/>Heure :'.$rdvNonPayes[$i][5].'<br/><form action="site.php" method="post"><input type="submit" name="reglerRdv" value="Régler ce rendez-vous" /><form></p>';
			}
		}
		require_once('gabaritAgents.php');
	}

	function afficherErreur($msg){
 		echo $msg;
	}