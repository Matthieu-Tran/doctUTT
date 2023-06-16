<!-- ----- début viewInserted -->


<div class="container">
    <!-- ===================================================== -->
    <?php
    if ($nbRdvExisted == 9) {
        echo "Votre emploi du temps est pleins pour aujourd'hui <br>";
    } else {
        echo "Vous ne pouvez pas ajouter autant de rendez vous pour cette même date <br>";
    }
    ?>
    <a href="router.php?action=rdvCreate" class="btn btn-danger">Retour</a>