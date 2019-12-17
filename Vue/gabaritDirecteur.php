<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Page du directeur</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Vue/style.css" />

</head>

<body>

    <h1>Environnement du Directeur</h1>

    <?php if(isset($exceptionLevee)){echo '<p class="msgErreurPageAgent">'.$exceptionLevee.'</p>';} ?>
        <fieldset>
            <legend>Creation d'un compte agent</legend>
            <form action="site.php" method="post">
                <p>
                    <label>login : </label>
                    <input type="text" name="login" required />
                    <br/>
                </p>
                <p>
                    <label>mot de passe : </label>
                    <input type="password" name="mdp" required/>
                    <br/>
                </p>
                <p>
                    <input type="submit" name="creerEmploye" value="Creer un compte" />
                </p>
            </form>
        </fieldset>

        <fieldset>
            <legend>Créer un médecin </legend>
            <form action="site.php" method="post">
                <p>
                    <label>login : </label>
                    <input type="text" name="loginMedecin" required />
                    <br/>
                </p>
                <p>
                    <label>mot de passe : </label>
                    <input type="password" name="mdpMedecin" required/>
                    <br/>
                </p>
                <p>
                    <label>Nom du médecin : </label>
                    <input type="text" name="nomMedecin" />
                    <br/>
                </p>
                <p>
                    <label>Prénom du médecin : </label>
                    <input type="text" name="prenomMedecin" />
                    <br/>
                </p>
                <p>
                    <label>Spécialité du médecin : </label>
                    <input type="text" name="specialite" />
                    <br/>
                </p>
                <p>
                    <input type="submit" name="creerMedecin" value="Créer le médecin" />
                    <br/>
                </p>
            </form>
        </fieldset>

        <fieldset>
            <legend>Modifier un compte employé </legend>
            <form action="site.php" method="post">

                <p>
                    <label>Login du compte voulant être modifie :</label>
                    <input type="text" name="loginRecherche" />
                </p>
                <p>
                    <label>Nouveau login souhaite : </label>
                    <input type="text" name="modifLogin" />
                </p>
                <p>
                    <label>Nouveau mot de passe : </label>
                    <input type="password" name="modifMdp" />
                    <p>
                        <input type="radio" name="grade" value="Agent" checked>
                        <label>Agent</label>
                        <br/>
                        <input type="radio" name="grade" value="Medecin">
                        <label>Médecin</label>
                        <br/>
                        <input type="radio" name="grade" value="Directeur">
                        <label>Directeur</label>
                        <br/>
                    </p>
                    <p>
                        <input type="submit" name="rechercherEmployes" value="Rechercher tous les employés de la catégorie coché" />
                        <input type="submit" name="modifierEmploye" value="Modifier le compte employe" />
                        <br/>
                    </p>

                    <?php 
        if(isset($contenuEmploye)){
        echo $contenuEmploye;
        }?>

            </form>
        </fieldset>

        <fieldset>
            <legend>Créer un motif de rdv</legend>
            <form action="site.php" method="post">
                <p>
                    <label>Nom du motif : </label>
                    <input type="text" name="nomMotif" required />
                    <br/>
                </p>
                <p>
                    <label>Consignes : </label>
                    <input type="text" name="consigne" value="Aucune" required />
                    <br/>
                </p>
                <p>
                    <label>Pièces justificatives : </label>
                    <input type="text" name="piece" value="Aucune" required/>
                    <br/>
                </p>
                <p>
                    <label>Prix : </label>
                    <input type="number" name="prix" step="0.01" min=0 required />
                    <br/>
                </p>
                <p>
                    <input type="submit" name="creerMotif" value="Créer un motif" />
                    <input type="submit" name="afficherMotifs" value="Afficher les motifs existants"
                    <br/>
                </p>
            </form>
        </fieldset>

        <fieldset>
            <legend>Modifier un motif de rdv</legend>
            <form action="site.php" method="post">

                <p>
                    <label>Nom du motif à modifier</label>
                    <input type="text" name="nomModif"/>
                </p>
        <?php 
        if(isset($contenuModif)){
        echo $contenuModif;
        }
        ?>
                <p>
                    <input type="submit" name="afficherMotifs" value="Afficher les motifs" />
                    <br/>
                    <input type="submit" name="modifierMotif" value="Modifier le motif saisi" />
                    <br/>
                </p>
            </form>
        </fieldset>

        <fieldset>
            <legend>Supprimer un motif de rdv </legend>
            <form action="site.php" method="post">
                <p>
                    <label>Entrez le nom du motif que vous souhaitez supprimer </label>
                    <input type="text" name="motifSupprimer" />
                    <p>
                        <input type="submit" name="supprimerMotif" value="Supprimer le motif coché" />
                        <br/>
                        <input type="submit" name="afficherMotifs" value="Afficher les motifs" />
                        <br/>
                    </p>
            </form>
        </fieldset>

        <fieldset>
            <legend>Supprimer un médecin </legend>
            <form action="site.php" method="post">

                <p>
                    <label>Id du Médecin à supprimer : </label>
                    <input type="number" min=0 name="idMedecin" />
                    <p>
                        <input type="submit" value="Afficher les médecins" name="afficherMedecins" />
                        <br/>
                    </p>
                    <?php 
        if(isset($contenuMedecin)){
        echo $contenuMedecin;
        }?>
                        <p>
                            <input type="submit" value="Supprimer un médecin" name="supprimerMedecin" />
                            <br/>
                        </p>
            </form>
        </fieldset>

</body>

</html>