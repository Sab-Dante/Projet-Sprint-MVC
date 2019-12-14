<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page des médecins</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="script_medecin.js"></script>

</head>

<body>
	<form>
		<fieldset><legend>Tâches administratives</legend>
			<label>Nombre de créneaux : </label>
			<input style="width:9%;" type="text" name="nb_creneau" onBlur="ajouter_zone()">
			<div id="ajouter"></div>

		</fieldset>
	</form>


    <?php echo $contenu;?>

</body>

</html>