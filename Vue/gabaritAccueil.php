<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page d'authentification</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="vue/style/style.css" />

</head>

<body>
	<form action="gabaritAccueil" method="post">
		<label>Login :</label><input type="text" name="login" /><br/>
		<label>Mot de passe :</label><input type="password" name="mdp"/><br/>
		<input type="radio" name="grade" value="Agent" checked><label>Agent</label><br/>
		<input type="radio" name="grade" value="Medecin"><label>Médecin</label><br/>
		<input type="radio" name="grade" value="Directeur"><label>Directeur</label><br/>
	</form>


    <?php 
    	if(isset($contenu)){
    		echo $contenu;
    	}?>

</body>

</html>