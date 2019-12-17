<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page des agents</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Vue/style.css" />

</head>

<body>
	<h1>Environnement Agents</h1>

	<?php if(isset($exceptionLevee)){echo '<p class="msgErreurPageAgent">'.$exceptionLevee.'</p>';} ?>

	<form action="site.php" method="post" >
		<fieldset>
			<legend>Ajouter nouveau patient</legend>
			<label for="nomPatient" >Nom :</label><input type="text" name="nomPatient" required /><br/>									<!--Formulaire de création de nouveaux patients-->
			<label for="prenomPatient" >Prenom :</label><input type="text" name="prenomPatient" required /><br/>
			<label for="adresse" >Adresse :</label><input type="text" name="adresse" required /><br/>
			<label for="numTel" maxlength="10" >Numero de téléphone</label><input type="tel" name="numTel" required /><br/>
			<label for="dateNaissance" ></label>Date de naissance :<input type="date" name="dateNaissance" required /><br/>
			<label for="depNaissance" >Département de naissance :</label><input type="text" name="depNaissance" required /><br/>
			<label for="numSecuriteSociale">Numero de sécurité social :</label><input type="text" name="numSecuriteSociale" required /><br/>
			<input type="submit" name="envoyerNvPatient" value="Creer le patient" />
			<input type="reset" name="effacerFormNvPatient" value="Effacer le formulaire" /><br/>
		</fieldset>
	</form>

	<form action="site.php" method="post">
		<fieldset>
			<legend>Consulter la synthèse d'un patient</legend>																			<!--Formulaire de consultation de synthèses-->
			<label for="codeSecuriteSociale" >Numero de sécurité social :</label><input type="text" name="codeSecuriteSociale" required /><br/>
			<input type="submit" name="envoyerSynthse" value="Consulter" />
			<?php if(isset($contenuSynthese)){echo $contenuSynthese;}?>
		</fieldset>
	</form>

	<form action="site.php" method="post" >
		<fieldset>
			<legend>Deposer sur un compte patient</legend>																				<!--Formulaire de depot sur compte patient-->
			<label for="codeSecuriteSociale">Numero de sécurité social :</label><input type="text" name="codeSecuriteSociale" required /><br/>
			<label for="montantDepot">Montant souhaité :</label><input type="number" name="montantDepot" required /><br/>
			<input type="submit" name="envoyerMontantDepot" value="Déposer" required />
		</fieldset>
	</form>

	<form action="site.php" method="post">
		<fieldset>
			<legend>Fixer un rendez-vous</legend>																						<!--Formulaire de prise de rendez-vous-->
			<label for="codeSecuriteSociale">Numero de sécurité social :</label><input type="text" value="<?php if(isset($_POST['codeSecuriteSociale'])){echo $_POST['codeSecuriteSociale'];}?>" name="codeSecuriteSociale" required /><br/>
			<label for="nomMedecinConsultant">Médecin :</label><input type="text" value="<?php if(isset($_POST['nomMedecinConsultant'])){echo $_POST['nomMedecinConsultant'];}?>" name="nomMedecinConsultant" required /><br/>
			<label for="specialiteMedecinConsultant">Specialité :</label><input type="text" value="<?php if(isset($_POST['specialiteMedecinConsultant'])){echo $_POST['specialiteMedecinConsultant'];}?>" name="specialiteMedecinConsultant" required /><br/>
			<label for="dateRdv">Date :</label><input type="date" value="<?php if(isset($_POST['dateRdv'])){echo $_POST['dateRdv'];}?>" name="dateRdv" required /><br/>
			<label for="heureRdv">Heure :</label><input type="number" value="<?php if(isset($_POST['heureRdv'])){echo $_POST['heureRdv'];}?>" name="heureRdv" max="23" min="0" required /><br/>
			<input type="submit" name="verifRDV" id="validerRdv" value="Verifier rendez-vous" />
			<input type="reset" name="effacerFormRdv"/><br/>
			
				
				<?php if(isset($listeMotifs)){echo $listeMotifs;}?>
				<?php if(isset($bouton)){echo $bouton;}?>
				
    		
			

		</fieldset>
	</form>

	<form action="site.php" method="post">
		<fieldset>														
			<legend>Visualiser les rendez-vous en attente de payement</legend>
			<label for="codeSecuriteSociale">Numero de sécurité social :</label><input type="text" name="codeSecuriteSociale" required/><br/>
			<input type="submit" name="visualiserRendezVous" value="Visualiser" />
			<?php if(isset($rendezVousEnAttenteDePayement)){echo $rendezVousEnAttenteDePayement;} ?>
		</fieldset>
	</form>
	<script src="Vue/jsPageAgent.js"></script>
</body>

</html>
