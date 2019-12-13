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
		<input type="checkbox" name="agent"><label>Agent</label><br/>
		<input type="checkbox" name="medecin"><label>Médecin</label><br/>
		<input type="checkbox" name="directeur"><label>Directeur</label><br/>
	</form>


    <?php 
    	if(isset($contenu)){
    		echo $contenu;
    	}?>

</body>

</html>