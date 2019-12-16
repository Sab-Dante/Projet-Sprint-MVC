<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page des médecins</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Vue/style.css" />
    <script type="text/javascript" src="Vue/script_medecin.js"></script>

</head>

<body>
	<form action="Vue/gabaritMedecins.php" method="post">
		<fieldset><legend>Tâches administratives</legend>
			<label>Nombre de créneaux : </label>
			<input style="width:9%;" type="text" name="nb_creneau" onBlur="ajouter_zone()">
			<div id="ajouter"></div>

		</fieldset>
	</form>

	<?php 
    	if(isset($contenu)){
    		echo $contenu;
    	}?>
    

</body>

</html>