<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page du directeur</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Vue/style.css" />

</head>

<body>
  <fieldset>
    <legend>Creation d'un compte employé</legend>
    <form action="site.php" method="post">
      <p>
        <label>login : </label><input type="text" name="login" required /><br/>
      </p>
      <p>
        <label>mot de passe : </label><input type="password" name="mdp" required/><br/>
      </p>
      <p>
        <label>Nom : </label><input type="text" name="nomMedecin" required/><br/>
      </p>
      <p>
        <label>Prénom : </label><input type="text" name="prenomMedecin" required /><br/>
      </p>
      <p>
        <label>Spécialité si médecin : </label><input type="text" name="specialite" /><br/>
      </p>
      <p>
        <input type="radio" name="grade" value="Agent" checked><label>Agent</label><br/>
        <input type="radio" name="grade" value="Medecin"><label>Médecin</label><br/>
        <input type="radio" name="grade" value="Directeur"><label>Directeur</label><br/>
      </p>
      <p>
        <input type="submit" name="creerEmploye" value="Creer"/>
      </p>
    </form>
  </fieldset>

  <fieldset>
    <legend>Modifier un compte employé </legend>
    <form action="site.php" method="post">
      <p>
        <label>Login de l'employé : </label><input type="text" name="loginRecherche" required /><br/>
      </p>
      <p>
        <input type="radio" name="grade" value="Agent" checked><label>Agent</label><br/>
        <input type="radio" name="grade" value="Medecin"><label>Médecin</label><br/>
        <input type="radio" name="grade" value="Directeur"><label>Directeur</label><br/>
      </p>
      <p>
        <input type="submit" name="rechercherEmploye" value="Rechercher l'employé"/>
        <input type="submit" name="modifierEmploye" value="Modifier l'employé coché"/><br/>
      </p>
<!-- code jss pour afficher deux input type pour le new login et le new mdp name= modifLogin, modifMdp -->

    <?php echo $contenu;?>
      </form>
    </fieldset>

    <fieldset>
      <legend>Créer un motif de rdv</legend>
      <form action="site.php" method="post">
        <p>
          <label>Nom du motif : </label><input type="text" name="nomMotif" required /><br/>
        </p>
        <p>
          <label>Consigne : </label><input type="text" name="consigne" required /><br/>
        </p>
        <p>
          <label>Pièce justificative : </label><input type="text" name="piece" required/><br/>
        </p>
        <p>
          <label>Prix : </label><input type="number" name="prix" step="0.01" required /><br/>
        </p>
        <p>
          <input type="submit" name="creerMotif" value="Créer un motif" /><br/>
        </p>
      </form>
    </fieldset>

    <fieldset>
      <legend>Modifier un motif de rdv</legend>
      <form action="site.php" method="post">
        <p>
          <label>Nom du motif à modifier</label><input type="text" name="nomModif" required /><br/>
        </p>
        <p>
          <label>Nouveau nom du motif</label><input type="text" name="nouveauNom" /><br/>
        </p>
        <p>
          <label>Consigne : </label><input type="text" name="nouvelleConsigne" /><br/>
        </p>
        <p>
          <label>Pièce justificative : </label><input type="text" name="nouvellePiece" /><br/>
        </p>
        <p>
          <label>Prix : </label><input type="number" name="nouveauPrix" step="0.01" /><br/>
        </p>
        <p>
          <input type="submit" name="modifierMotif" value="Modifier un motif" /><br/>
        </p>
      </form>
    </fieldset>

    <fieldset>
      <legend>Supprimer un motif de rdv </legend>
      <form action="site.php" method="post">
        <p>
          <label>Nom du motif à supprimer</label><input type="text" name="motifSupprimer"  /><br/>
        </p>
        <p>
          <input type="submit" name="supprimerMotif" value="Supprimer le motif" /><br/>
          <input type="submit" name="afficherMotifs" value="Afficher les motifs" /><br/>
        </p>
      </form>
    </fieldset>

    <fieldset>
      <legend>Supprimer un médecin </legend>
      <form action="site.php" method="post">
            <p>
                <input type="submit" value="Afficher les médecins" name="afficherMedecins" /><br/>
            </p>
            <?php echo $contenu;?>
            <p>
                <input type="submit" value="Supprimer un médecin" name="supprimerMedecin" /><br/>
            </p>
      </form>
    </fieldset>

</body>

</html>