<div class="login-form" style="min-height: 80vh; margin-top: 200px;">
    <?php
    if (isset($_GET['reg_err'])) {
        $err = htmlspecialchars($_GET['reg_err']);
        switch ($err) {
            case 'success':
    ?>
                <div class="alert alert-success">
                    <strong>Succès</strong> Inscription réussie !
                </div>
            <?php
                break;

            case 'password':
            ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> Les deux mots de passe sont différents
                </div>
            <?php
                break;

            case 'already':
            ?>
                <div class="alert alert-danger">
                    <strong>Erreur</strong> Compte déjà existant
                </div>
    <?php
        }
    }
    ?>
    <div class="container p-2 rounded" style="max-width: 500px;">
        <div class="card-body">
            <form action="router.php?action=inscription_traitement" method="post">
                <h2 class="text-center">Inscription</h2>
                <div class="form-group m-1">
                    <input type="text" name="Prenom" class="form-control" placeholder="Prenom" value="<?php if (isset($_COOKIE["prenomUtilisateur"])) {
                                                                                                            echo $_COOKIE["prenomUtilisateur"];
                                                                                                        } ?>" required="required" autocomplete="off">
                </div>
                <div class="form-group m-1">
                    <input type="text" name="Nom" class="form-control" placeholder="Nom" value="<?php if (isset($_COOKIE["nomUtilisateur"])) {
                                                                                                    echo $_COOKIE["nomUtilisateur"];
                                                                                                } ?>" required="required" autocomplete="off">
                </div>

                <div class="form-group m-1">
                    <input type="text" name="Adresse" class="form-control" placeholder="Adresse" value="<?php if (isset($_COOKIE["pseudonyme"])) {
                                                                                                            echo $_COOKIE["pseudonyme"];
                                                                                                        } ?>" required="required" autocomplete="off">
                </div>
                <div class="form-group m-1">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group m-1">
                    <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez le mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group m-1">
                    <label for="statut-select">Votre statut</label>
                    <select name="statut" id="statut-select" class="form-control">
                        <option value="0">Administrateur</option>
                        <option value="1">Praticien</option>
                        <option value="2">Patient</option>
                    </select>
                </div>

                <div class="form-group m-1">
                    <label for="specialite-select">Votre spécialité si vous êtes praticien</label>
                    <select name="specialite" id="specialite-select" class="form-control">
                        <option value="0">Je ne suis pas un praticien</option>
                        <option value="1">Médecin généraliste</option>
                        <option value="2">Infirmier</option>
                        <option value="3">Dentiste</option>
                        <option value="4">Sage-femme</option>
                        <option value="5">Ostéopathe</option>
                        <option value="6">Kinésithérapeute</option>
                    </select>
                </div>
                <div class="form-group m-1">
                    <button type="submit" class="btn btn-primary btn-block">Inscription</button>
                </div>
            </form>
        </div>
    </div>
    <p class="text-center">Vous avez déja un compte ?</p>
    <p class="text-center"><a href="router.php?action=connexion">Connectez vous</a></p>
</div>