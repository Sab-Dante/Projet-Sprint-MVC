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

	function ajouterPatient($nom,$prenom,$pays,$adresse,$tel,$dateNaissance,$depNaissance,$nSecu){
		$connexion=getConnect();
		$requete=$connexion->prepare("INSERT INTO patient(NSS,nom,prenom,pays,adresse,numtel,datenaissance,depnaissance) VALUES(:nSecu,:nom,:prenom,:pays,:adresse,:tel,:dateNaissance,:depNaissance)");
		$requete->bindValue(':nSecu', $nSecu, PDO::PARAM_STR);
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->bindValue(':prenom', $prenom, PDO::PARAM_STR);
		$requete->bindValue(':pays', $pays, PDO::PARAM_STR);
		$requete->bindValue(':adresse', $adresse, PDO::PARAM_STR);
		$requete->bindValue(':tel', $tel, PDO::PARAM_STR);
		$requete->bindValue(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
		$requete->bindValue(':depNaissance', $depNaissance, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();
	}

	function modifierPatient($nom,$prenom,$pays,$adresse,$tel,$dateNaissance,$depNaissance,$nSecu){
		$connexion=getConnect();
		$requete=$connexion->prepare("UPDATE patient SET nom=:nom, prenom=:prenom, pays=:pays, adresse=:adresse, numTel=:tel, dateNaissance=:dateNaissance, depNaissance=:depNaissance WHERE nss=:nSecu");
		$requete->bindValue(':nSecu', $nSecu, PDO::PARAM_STR);
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->bindValue(':prenom', $prenom, PDO::PARAM_STR);
		$requete->bindValue(':pays', $pays, PDO::PARAM_STR);
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

	function getSolde($nSecu){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT solde FROM patient WHERE nss=:nSecu");
		$requete->bindValue(':nSecu', $nSecu, PDO::PARAM_STR);
		$requete->execute();
		$res = $requete->fetchall();

		$requete->closeCursor();
		return $res;
	}

	function ajouterMontant($nSecu,$montant){
		$connexion=getConnect();
		$requete=$connexion->prepare("UPDATE patient SET solde = solde + :montant WHERE nss=:nSecu");
		$requete->bindValue(':montant', $montant, PDO::PARAM_STR);
		$requete->bindValue(':nSecu', $nSecu, PDO::PARAM_STR);
		$requete->execute();
		
		$requete->closeCursor();
	}

	function getRdvNonPayes($nSecu){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT * FROM rendezvous WHERE nssRdv=:nSecu AND enAttenteDePayement=1");
		$requete->bindValue(':nSecu', $nSecu, PDO::PARAM_STR);
		$requete->execute();
		$res = $requete->fetchall();
		$requete->closeCursor();
		return $res;
	}

	function getPrix($nomMotif){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT prix FROM motif WHERE nom=:nomMotif");
		$requete->bindValue(':nomMotif', $nomMotif, PDO::PARAM_STR);
		$requete->execute();
		$res = $requete->fetchall();
		$requete->closeCursor();
		return $res;		
	}

	function debiter($nSecu,$prix){
		$connexion=getConnect();
		$requete=$connexion->prepare("UPDATE patient SET solde = solde - :prix WHERE nss=:nSecu");
		$requete->bindValue(':prix', $prix, PDO::PARAM_STR);
		$requete->bindValue(':nSecu', $nSecu, PDO::PARAM_STR);
		$requete->execute();
		
		$requete->closeCursor();
	}

	function payementEffectué($idRdv){
		$connexion=getConnect();
		$requete=$connexion->prepare("UPDATE rendezvous SET enAttenteDePayement=0 WHERE idrendezvous=:idRdv");
		$requete->bindValue(':idRdv', $idRdv, PDO::PARAM_STR);
		$requete->execute();
		
		$requete->closeCursor();		
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

	function creerEmploye($login,$mdp,$grade){
		$connexion=getConnect();
		$requete=$connexion->prepare("INSERT INTO $grade(login,motdepasse) VALUES(:login,:mdp)");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();

	}
	//////////////////////////////////////////////

	function ajouterCreneau($login,$date, $hour){
		$connexion=getConnect();
		$requete=$connexion->prepare("INSERT INTO emploidutemps(idmedecin,date,heure) VALUES(:id,:date,:heure)");
		$requete->bindValue(':id', $login, PDO::PARAM_INT);
		$requete->bindValue(':date', $date, PDO::PARAM_STR);
		$requete->bindValue(':heure', $hour, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();
	}
	function checkCreneau($login,$date, $hour){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT COUNT(*) from emploidutemps where idmedecin=:id and date=:date and heure=:heure UNION SELECT COUNT(*) from rendezvous where nommedecin=:id and date=:date and heure=:heure");
		$requete->bindValue(':id', $login, PDO::PARAM_INT);
		$requete->bindValue(':date', $date, PDO::PARAM_STR);
		$requete->bindValue(':heure', $hour, PDO::PARAM_STR);
		$requete->execute();
		$existe=$requete->fetch();
		$requete->closeCursor();
		return $existe;
	}
	
	function recupMotif(){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT nom from motif");
		$requete->execute();
		$motif=$requete->fetchall();
		$requete->closeCursor();
		return $motif;

	}


	function checkMedecins($login){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT login from medecin WHERE idmedecin=:login");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->execute();
		$login=$requete->fetch();
		$requete->closeCursor();
		return $login;

	}


	function specialiteMedecin($login){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT specialite from medecin WHERE idmedecin=:login");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->execute();
		$spe=$requete->fetch();
		$requete->closeCursor();
		return $spe;
	}

	function ajouterRDV($nss, $login, $specialite,$date, $hour, $motif){
		$connexion=getConnect();
		$requete=$connexion->prepare("INSERT INTO rendezvous(idrendezvous,nssrdv,nommedecin,specialite,date,heure,nommotif,enattentedepayement) VALUES(0,:nss,:login,:specialite,:date,:hour,:motif,1)");
		$requete->bindValue(':nss', $nss, PDO::PARAM_STR);
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->bindValue(':specialite', $specialite, PDO::PARAM_STR);
		$requete->bindValue(':date', $date, PDO::PARAM_STR);
		$requete->bindValue(':hour', $hour, PDO::PARAM_INT);
		$requete->bindValue(':motif', $motif, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();
	}

	function checkRDV($nss, $date, $hour){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT COUNT(*) from rendezvous where nssrdv=:nss and date=:date and heure=:heure");
		$requete->bindValue(':nss', $nss, PDO::PARAM_INT);
		$requete->bindValue(':date', $date, PDO::PARAM_STR);
		$requete->bindValue(':heure', $hour, PDO::PARAM_STR);
		$requete->execute();
		$existe=$requete->fetch();
		$requete->closeCursor();
		return $existe;
	}
	
	/////////////////////////////////////////////

	function modifierEmploye($loginRecherche,$login,$mdp,$grade){
		$connexion=getConnect();
		$requete=$connexion->prepare("UPDATE $grade SET login=:login, motdepasse=:mdp WHERE login=:loginRecherche ");
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

	function getMotif($nom){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT * FROM motif WHERE nom=:nom");
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->execute();
		$motif=$requete->fetchall();
		$requete->closeCursor();
		return $motif;		
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

	function validerModif($nom,$newNom,$newConsigne,$nouvellePiece,$nouveauPrix){
		$connexion=getConnect();
		$requete=$connexion->prepare("UPDATE motif SET nom=:newNom,consigne=:newConsigne,pieces=:nouvellePiece,prix=:nouveauPrix WHERE nom=:nom");
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->bindValue(':newNom', $newNom, PDO::PARAM_STR);
		$requete->bindValue(':newConsigne', $newConsigne, PDO::PARAM_STR);
		$requete->bindValue(':nouvellePiece', $nouvellePiece, PDO::PARAM_STR);
		$requete->bindValue(':nouveauPrix', $nouveauPrix, PDO::PARAM_INT);
		$requete->execute();
		$requete->closeCursor();
	}	

	function supprimerMotif($nom){
		$connexion=getConnect();
		$requete=$connexion->prepare("DELETE FROM motif WHERE nom=:nom");
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();
	}

	function creerMedecin($login,$mdp,$nom,$prenom,$spe){
		$connexion=getConnect();
		$requete=$connexion->prepare("INSERT INTO medecin(login,motdepasse,nom,prenom,specialite) VALUES(:login,:mdp,:nom,:prenom,:spe) ");
		$requete->bindValue(':login', $login, PDO::PARAM_STR);
		$requete->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$requete->bindValue(':nom', $nom, PDO::PARAM_STR);
		$requete->bindValue(':prenom', $prenom, PDO::PARAM_STR);
		$requete->bindValue(':spe', $spe, PDO::PARAM_STR);
		$requete->execute();
		$requete->closeCursor();
	}

	function getEmployes($grade){
		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT * FROM $grade");
		$requete->execute();
		$listeEmployes=$requete->fetchall();
		$requete->closeCursor();
		return $listeEmployes;

	}

	function checkId($id){

		$connexion=getConnect();
		$requete=$connexion->prepare("SELECT idMedecin from Medecin WHERE idMedecin=:id");
		$requete->bindValue(':id', $id, PDO::PARAM_INT);
		$requete->execute();
		$id=$requete->fetch();
		$requete->closeCursor();
		return $id;

	}


	function supprimerMedecin($id){
		$connexion=getConnect();
		$requete=$connexion->prepare("DELETE FROM medecin WHERE idMedecin=:id");
		$requete->bindValue(':id', $id, PDO::PARAM_INT);
		$requete->execute();
		$requete->closeCursor();
	}