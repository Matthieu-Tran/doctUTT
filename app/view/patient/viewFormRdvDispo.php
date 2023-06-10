<!-- ----- début viewInsert -->

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <h1>Rendez-vous disponibles du praticien <?php echo $praticien->getNom() . ' ' . $praticien->getPrenom() ?></h1>
        <form action="router.php?action=updateRdv" method="post">
            <input type="hidden" name="praticien_id" value="<?php echo $praticienId; ?>">
            <label for="rdv">Sélectionnez un rendez-vous :</label>
            <select name="rdv" id="rdv">
                <!-- Code PHP pour afficher la liste des rendez-vous disponibles -->
                <?php foreach ($rdvDisponibles as $rdv) : ?>
                    <option value="<?php echo $rdv->getId(); ?>"><?php echo $rdv->getRdvDate(); ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <button class="btn btn-primary" type="submit">Prendre le rendez vous</button>
        </form>
        <p />
    </div>

    <!-- ----- fin viewInsert -->