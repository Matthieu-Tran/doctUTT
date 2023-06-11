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
        <form action="router.php?action=selectionnezRdv" method="post">
            <input type="hidden" name='action' value='selectionnezRdv'>
            <label for="praticien">Sélectionnez un praticien :</label>
            <select name="praticien" id="praticien">
                <!-- Code PHP pour afficher la liste des praticiens -->
                <?php foreach ($praticiens as $praticien) : ?>
                    <option value="<?php echo  $praticien->getId(); ?>"><?php echo $praticien->getNom() . ' ' . $praticien->getPrenom(); ?></option>
                <?php endforeach; ?>
            </select>
            <p />
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        <p />
    </div>

    <!-- ----- fin viewInsert -->