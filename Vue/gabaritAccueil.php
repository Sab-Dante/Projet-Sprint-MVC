<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page d'authentification</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Vue/style.css" />

</head>

<body>
	<h1>QUI ES TU ETRANGER</h1>
	<form action="site.php" method="post">
		<fieldset>
			<legend>Connexion</legend>
			<label>Login :</label><input type="text" name="login" /><br/>
			<label>Mot de passe :</label><input type="password" name="mdp"/><br/>
			<input type="radio" name="grade" value="Agent" checked><label>Agent</label><br/>
			<input type="radio" name="grade" value="Medecin"><label>Médecin</label><br/>
			<input type="radio" name="grade" value="Directeur"><label>Directeur</label><br/>
			<input type="submit" name="seConnecter" value="Connexion" />
			<?php if(isset($msgErreurAccueil)){echo $msgErreurAccueil;} ?>
		</fieldset>
	</form>


    <?php 
    	if(isset($contenu)){
    		echo $contenu;
    	}?>

</body>

</html>