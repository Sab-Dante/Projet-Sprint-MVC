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
		
		if ($requete->fetch()) {
			$res=true;
		}

		return $res;
	}

	function ajouterEmploye($login,$mdp,$grade){


	}
	function modifierEmploye($login,$mdp){


	}
	function creerMotif($nom,$consigne,$piece,$prix){


	}
	function checkNomMotif($nom){


	}
	function modifierMotif($newNom,$newConsigne,$nouvellePiece,$nouveauPrix){


	}
	function supprimerMotif($nom){


	}
	function getMotifs(){


	}
	function creerMedecin($nom,$prenom,$spe){


	}
	function getMedecins(){


	}
	function supprimerMedecin($id){


	}
	
	function ajouterPatient(){


	}
	function synthesePatient($nSecu){


	}
	function ajouterMontant($nSecu,$montant){


	}
	function rdvNonPayes($nSecu){


	}

	function 