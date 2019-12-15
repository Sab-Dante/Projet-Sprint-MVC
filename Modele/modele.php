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

	function ajouterMontant($nSecu,$montant){


	}
	function rdvNonPayes($nSecu){


	}

	//Fonctions du DIRECTEUR// :

	function checkLogin($login,$grade){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT login from $grade WHERE login=:login");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->execute();
		$login=$requete->fetch();
		$requete->closeCursor();
		return $login;

	}

	function ajouterEmploye($login,$mdp,$grade){
		$connexion=getConnect();
		$requete=$connexion->prepare("INSERT INTO $grade(login,mdp) VALUES(:login,:mdp)");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();

	}


	function modifierEmploye($loginRecherche,$login,$mdp,$grade){
		$connexion=getConnect();
		$requete=$connexion->prepare("UPDATE $grade SET login=:login, mdp=:mdp WHERE login=:loginRecherche ");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$requete->bindValue(':loginRecherche', $loginRecherche, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();
	}


	function creerMotif($nom,$consigne,$piece,$prix){
		$connexion=getConnect();
		$requete=$connexion->prepare("INSERT INTO motif(nom,consigne,pieces,prix) VALUES(:nom,:consigne,:piece,:prix)");
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->bindValue(':consigne', $consigne, PDO::PARAM_STR);
		$requete->bindValue(':piece', $piece, PDO::PARAM_STR);
		$requete->bindValue(':prix', $prix, PDO::PARAM_INT);
		$requete->execute();
		$requete->closeCursor();

	}

	function getMotifs(){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT * FROM motif");
		$requete->execute();
		$motifs=$requete->fetchall();
		$requete->closeCursor();
		return $motifs;
	}

	function checkNomMotif($nom){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT nom FROM motif WHERE nom=:nom");
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->execute();
		$nom=$requete->fetchall();
		$requete->closeCursor();
		return $nom;
	}

	function modifierMotif($newNom,$newConsigne,$nouvellePiece,$nouveauPrix){
		$connexion=getConnect();
		$requete=$connexion->prepare("UPDATE motif SET nom=:newNom,consigne=:newConsigne,piece=:nouvellePiece,prix=:nouveauPrix");
		$requete->bindValue(':newNom', $newNom, PDO::PARAM_STR);
		$requete->bindValue(':newConsigne', $newConsigne, PDO::PARAM_STR);
		$requete->bindValue(':nouvellePiece', $nouvellePiece, PDO::PARAM_STR);
		$requete->bindValue(':nouveauPrix', $nouveauPrix, PDO::PARAM_INT);
		$requete->execute();
		$requete->closeCursor();
	}

	function supprimerMotif($nom){
		$connexion=getConnect();
		$requete=$connexion->prepare("DELETE * FROM motif WHERE nom=:nom");
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();
	}

	function getMedecins(){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT * FROM medecin");
		$requete->execute();
		$requete->closeCursor();
	}


	function supprimerMedecin($id){
	$connexion=getConnect();
	$requete=$connexion->prepare("DELETE * FROM medecin WHERE id=:id");
	$requete->bindValue(':id', $login, PDO::PARAM_INT);
	$requete->execute();
	$requete->closeCursor();
	}

		
	function ajouterCreneau($date, $hour){
	$connexion=getConnect();
	$requete=$connexion->prepare("INSERT INTO emploidutemps(idmedecin,date,heure) VALUES(:id,:date,:heure)");
	//$$requete->bindValue(':id', $login, PDO::PARAM_INT);
	$requete->bindValue(':date', $date, PDO::PARAM_STR);
	$requete->bindValue(':heure', $hour, PDO::PARAM_STR);
	$requete->execute();
	$requete->closeCursor();
	}