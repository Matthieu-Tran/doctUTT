<!-- ----- début viewInserted -->


<div class="container">
    <!-- ===================================================== -->
    <?php
    if ($results > 0) {
        echo ("<h3>Les rendez-vous ont bien été ajouté </h3>");
        echo ("<ul>");
        foreach ($results as $res) {
            echo ("<li>idRdv = " . $res . "</li>");
            echo ("<ul>");
            echo ("<li>date = " . $_POST['date'] . "</li>");
            echo ("</ul>");
        }
        echo ("<li>Nombre rdv ajoutés = " . $_POST["nombre_rdv"] . "</li>");
        echo ("</ul>");
    } else {
        echo ("<h3>Problème d'insertion des rendez-vous</h3>");
    }

    echo ("</div>");
    ?>

    <!-- ----- fin viewInserted -->