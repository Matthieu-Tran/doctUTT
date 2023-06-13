<!-- ----- début viewInserted -->

<div class="container">
    <!-- ===================================================== -->
    <?php
    if ($result) {
        echo ("<h3>Le rendez vous a bien été pris </h3>");
        echo "Rendez-vous ID: " . $rdv->getId();
    } else {
        echo ("<h3>Problème dans la prise de rendez-vous</h3>");
    }

    echo ("</div>");
    ?>
    <!-- ----- fin viewInserted -->