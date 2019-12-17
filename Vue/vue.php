<?php

	function afficherAccueil(){
		require_once('gabaritAccueil.php');
	}

	function afficherErreurAccueil($msg){
		$msgErreurAccueil='<div class="msgErreurConnexion"><p>'.$msg.'</p></div>';
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

	function afficherFormModifPatient($infoAModifier){
		$contenuModifPatient = '<label for="nom">Nom : </label><input type="text" name="nom" onBlur="testNomPrenomPays(this)" value="'.$infoAModifier[0][1].'" /><br/><label for="prenom">Prenom : </label><input type="text" name="prenom" onBlur="testNomPrenomPays(this)" value="'.$infoAModifier[0][2].'" /><br/><label for="pays">Pays : </label><input type="text" name="pays" onBlur="testNomPrenomPays(this)" value="'.$infoAModifier[0][3].'" /><br/><label for="adresse">Adresse : </label><input type="text" name="adresse" value="'.$infoAModifier[0][4].'" /><br/><label for="numTel">Numero de téléphone : </label><input type="text" name="numTel" maxlength="10" onBlur="testNumTel(this)" value="'.$infoAModifier[0][5].'" /><br/><label for="dateNaissance">Date de naissance : </label><input type="text" name="dateNaissance" value="'.$infoAModifier[0][6].'" /><br/><label for="depNaissance">Département de naissance : </label><input type="text" name="depNaissance" onBlur="testDepNaissance(this)" value="'.$infoAModifier[0][7].'" /><br/><br/><label for="nSecu">Numero de sécurité social : </label><input type="text" name="nSecu" /><br/><input type="submit" name="modifierPatient" value="Modifier le patient" />';
		require_once('gabaritAgents.php');
	}

	function afficherSynthese($infoPatient){
		$contenuSynthese = '<p>Numero de sécurité social : '.$infoPatient[0][0].'<br/>Nom : '.$infoPatient[0][1].'<br/>Prenom : '.$infoPatient[0][2].'<br/>Pays : '.$infoPatient[0][3].'<br/>Adresse : '.$infoPatient[0][4].'<br/> Numero de téléphone : +33'.$infoPatient[0][5].'<br/> Date de Naissance : '.$infoPatient[0][6].'<br/>Departement de naissance : '.$infoPatient[0][7].'<br/> Solde sur le compte du patient : '.$infoPatient[0][8].'</p>';
		require_once('gabaritAgents.php');
	}

	function afficherMontants($ancienMontant,$nvMontant){
		$contenuMontants='<div class="montant"><p>Le solde avant l\'opération était de : '.$ancienMontant[0][0].'€<br/>Votre nouveau solde est de : '.$nvMontant[0][0].'€</p></div>';
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
				$rendezVousEnAttenteDePayement.= '<p class="rdvNonPaye"><form action="site.php" method="post"><label>Medecin : </label><input type="text" name="medecin" value="'.$rdvNonPayes[$i][2].'" /><br/><label>Specialité : </label><input type="text" name="specialite" value="'.$rdvNonPayes[$i][3].'" /><br/><label>Date : </label><input type="text" name="date" value="'.$rdvNonPayes[$i][4].'" /><br/><label>Heure : </label><input type="text" name="heure" value="'.$rdvNonPayes[$i][5].'" /><br/><label>Motif : </label><input type="text" name="motif" value="'.$rdvNonPayes[0][6].'" /><br/><div style="display :none ;"><input type="text" name="idRdvNonPaye" value="'.$rdvNonPayes[$i][0].'" /><input type="text" name="nssRdvNonPaye" value="'.$rdvNonPayes[$i][1].'" /></div><input type="submit" name="reglerRdv" value="Régler ce rendez-vous" /><form></p>';
			}
		}
		require_once('gabaritAgents.php');
	}

	function afficherEmployes($listeEmployes,$grade){
		$contenuEmploye="";
		if ($grade=="Directeur"){
			for($i=0;$i<count($listeEmployes); $i++){
				$contenuEmploye.='
				<p>Directeur '.$i.' | <label > login : 
				</label><input type="text" disabled name="login" id="employe'.$i.'" value="'.$listeEmployes[$i][0].'"
				<label> mdp : </label><input type="text" name="mdp" disabled id="employe'.$i.'" value="'.$listeEmployes[$i][1].'"
				</p><br/>
		
		';
					}
		}
		else if($grade=="Agent"){
			for($i=0;$i<count($listeEmployes); $i++){
			$contenuEmploye.='
			<p>Agent '.$i.' | <label > login : 
			</label><input type="text" disabled name="login" id="employe'.$i.'" value="'.$listeEmployes[$i][1].'"
			<label> mdp : </label><input type="text" name="mdp" disabled id="employe'.$i.'" value="'.$listeEmployes[$i][2].'"
			</p><br/>
			
			';			
			}
		}
		else{
			for($i=0;$i<count($listeEmployes); $i++){
			$contenuEmploye.='
			<p>Médecin '.$i.' | <label > login : 
			</label><input type="text" disabled name="login" id="employe'.$i.'" value="'.$listeEmployes[$i][1].'"
			<label> mdp : </label><input type="text" name="mdp" disabled id="employe'.$i.'" value="'.$listeEmployes[$i][2].'"
			</p><br/>
		
		';
			}
		}
		require_once('gabaritDirecteur.php');

	}

	function afficherMedecins($listeEmployes){
			$contenuMedecin="";
		for($i=0;$i<count($listeEmployes); $i++){
			$contenuMedecin.='
			<p>Médecin '.$i.' | <label > Id du Médecin : 
			</label><input type="text" disabled name="login" id="employe'.$i.'" value="'.$listeEmployes[$i][0].'"
			<label> Nom : </label><input type="text" name="mdp" disabled id="employe'.$i.'" value="'.$listeEmployes[$i][3].'"
			<label> Prénom : </label><input type="text" name="mdp" disabled id="employe'.$i.'" value="'.$listeEmployes[$i][4].'"
			</p><br/>			
			';

		}
		require_once('gabaritDirecteur.php');
		
	function reglerRdvNonPaye($id){

	}

	function afficherErreur($msg){
 		echo $msg;
	}