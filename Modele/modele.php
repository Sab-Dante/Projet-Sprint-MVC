<?php
	require_once('connect.php');

	function getConnect() {
		$connexion=new PDO('mysql:host='.SERVEUR.';dbname='.BDD,USER,PASSWORD);
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connexion->query('SET NAMES UTF8');
 		return $connexion;
	}

	
	function testConnexion($login,$mdp,$grade){
		$res = false;
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT login,motdepasse FROM $grade WHERE login = :login AND motdepasse = :mdp");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$requete->execute();
		$nbr = $requete->rowCount();
		
		if ($nbr == 1) {
			$res=true;
		}
		$requete->closeCursor();
		return $res;
	}

	function nssLibre($nSecu){
		$res = false;

		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT * FROM patient WHERE nss=:nSecu");
		$requete->bindValue(':nSecu', $nSecu, PDO::PARAM_STR);
		$requete->execute();
		$nbr = $requete->rowCount();

		if($nbr==0){
			$res = true;
		}

		return $res;
	}

	function ajouterPatient($nom,$prenom,$adresse,$tel,$dateNaissance,$depNaissance,$nSecu){
		$connexion=getConnect();
		$requete=$connexion->prepare("INSERT INTO patient(NSS,nom,prenom,adresse,numtel,datenaissance,depnaissance) VALUES(:nSecu,:nom,:prenom,:adresse,:tel,:dateNaissance,:depNaissance)");
		$requete->bindValue(':nSecu', $nSecu, PDO::PARAM_STR);
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->bindValue(':prenom', $prenom, PDO::PARAM_STR);
		$requete->bindValue(':adresse', $adresse, PDO::PARAM_STR);
		$requete->bindValue(':tel', $tel, PDO::PARAM_STR);
		$requete->bindValue(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
		$requete->bindValue(':depNaissance', $depNaissance, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();
	}

	function getSynthesePatient($nSecu){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT * FROM patient WHERE nss=:nSecu");
		$requete->bindValue(':nSecu', $nSecu, PDO::PARAM_STR);
		$requete->execute();
		$res = $requete->fetchall();
		
		$requete->closeCursor();
		return $res;
	}