<?php

	require_once('connect.php');	

	
	function testConnexion($login,$mdp,$grade){
		$res = false;
		$requete = $connexion->prepare("SELECT login,motdepasse FROM :grade WHERE login = :login && motdepasse = :mdp ");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$requete->bindValue(':grade', $grade, PDO::PARAM_STR);
		$requete->execute();
		
		if ($requete->fetch()) {
			$res=true;
		}
	}
