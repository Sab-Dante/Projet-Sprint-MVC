<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page des agents</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Vue/style.css" />
    <script src="Vue/jsPageAgent.js"></script>

</head>

<body>
	<h1>Environnement Agents</h1>

	<?php if(isset($exceptionLevee)){echo '<p class="msgErreurPageAgent">'.$exceptionLevee.'</p>';} ?>

	<form action="site.php" method="post" >
		<fieldset>
			<legend>Ajouter nouveau patient</legend>
			<label for="nomPatient" >Nom : </label><input type="text" name="nomPatient" onBlur="testNomPrenomPays(this)" required /><br/>	<!--Formulaire de création de nouveaux patients-->
			<label for="prenomPatient" >Prenom : </label><input type="text" name="prenomPatient" onBlur="testNomPrenomPays(this)" required /><br/>
			<label for="adresse" >Adresse : </label><input type="text" name="adresse" onBlur="testAdresse(this)" required /><br/>
			<label for="numTel">Numero de téléphone : </label><input type="tel" name="numTel" maxlength="10" onBlur="testNumTel(this)" required /><br/>
			<label for="dateNaissance" ></label>Date de naissance : <input type="date" name="dateNaissance" required /><br/>
			<label for="depNaissance" >Département de naissance : </label><input type="text" name="depNaissance" onBlur="testDepNaissance(this)" required />
			<div id="autrePays"></div>
			<br/><label for="numSecuriteSociale">Numero de sécurité social : </label><input type="text" name="numSecuriteSociale" maxlength="13" onBlur="testnSecu(this)" required /><br/>
			<input type="submit" name="envoyerNvPatient" value="Creer le patient" />
			<input type="reset" name="effacerFormNvPatient" value="Effacer le formulaire" /><br/>
		</fieldset>
	</form>

	<form action="site.php" method="post" >
		<fieldset>
			<legend>Modifier l'identité d'un patient</legend>																			<!--Formulaire de modification d'identité d'un patient-->
			<?php 
				if(isset($contenuModifPatient)){
					echo $contenuModifPatient;
				}
				else{
					echo '<label for="numSecuriteSociale">Numero de sécurité social :</label><input type="text" name="numSecuriteSociale" required /><br/><input type="submit" name="accederPatient" value="Accéder au profil" />';
				} 
			?>
		</fieldset>
	</form>

	<form action="site.php" method="post">
		<fieldset>
			<legend>Consulter la synthèse d'un patient</legend>																			<!--Formulaire de consultation de synthèses-->
			<label for="codeSecuriteSociale" >Numero de sécurité social : </label><input type="text" name="codeSecuriteSociale" required /><br/>
			<input type="submit" name="envoyerSynthese" value="Consulter" />
			<?php if(isset($contenuSynthese)){echo $contenuSynthese;} ?>
		</fieldset>
	</form>

	<form action="site.php" method="post" >
		<fieldset>
			<legend>Deposer sur un compte patient</legend>																				<!--Formulaire de depot sur compte patient-->
			<label for="codeSecuriteSociale">Numero de sécurité social :</label><input type="text" name="codeSecuriteSociale" required /><br/>
			<label for="montantDepot">Montant souhaité :</label><input type="number" name="montantDepot" required /><br/>
			<input type="submit" name="envoyerMontantDepot" value="Déposer" required />
			<?php if(isset($contenuMontants)){echo $contenuMontants;}?>
		</fieldset>
	</form>

	<form action="site.php" method="post">
		<fieldset>
			<legend>Fixer un rendez-vous</legend>																						<!--Formulaire de prise de rendez-vous-->
			<label for="codeSecuriteSociale">Numero de sécurité social :</label><input type="text" name="codeSecuriteSociale" required /><br/>
			<label for="nomMedecinConsultant">Médecin :</label><input type="text" name="nomMedecinConsultant" required /><br/>
			<label for="specialiteMedecinConsultant">Specialité :</label><input type="text" name="specialiteMedecinConsultant" required /><br/>
			<label for="dateRdv">Date :</label><input type="date" name="dateRdv" required /><br/>
			<label for="heureRdv">Heure :</label><input type="time" name="heureRdv" step="3600" required /><br/>
			<input type="button" name="afficherMotifs" id="consulter" value="Consulter" onclick="jsAfficherMotifsAgent()"/><br/>
			<div style="display: none ;" id="motifsAgent">
			</div>
			<input type="submit" name="afficherMotifs" id="validerRdv" value="Valider rendez-vous" />
			<input type="reset" name="effacerFormRdv"/><br/>
		</fieldset>
	</form>

	<form action="site.php" method="post">
		<fieldset>														
			<legend>Visualiser les rendez-vous en attente de payement</legend>
			<label for="codeSecuriteSociale">Numero de sécurité social :</label><input type="text" name="codeSecuriteSociale" required/><br/>
			<input type="submit" name="visualiserRendezVousNonPayes" value="Visualiser" />
		</fieldset>
	</form>
	<div class="rdvNonPaye">
		<?php if(isset($rendezVousEnAttenteDePayement)){echo $rendezVousEnAttenteDePayement;} ?>
	</div>
</body>

</html>
