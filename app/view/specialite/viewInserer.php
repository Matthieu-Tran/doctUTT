<!-- ----- début viewInserer -->


<div class="container">
    <!-- ===================================================== -->
    <?php
    if ($results) {
        echo ("<h3>La nouvelle spécialité a été ajouté </h3>");
        echo ("<ul>");
        echo ("<li>Label = " . $_GET['label'] . "</li>");
        echo ("</ul>");
    } else {
        echo ("<h3>Problème d'insertion de la nouvelle spécialité</h3>");
        echo ("id = " . $_GET['id']);
    }

    echo ("</div>");
    ?>


    <!-- ----- fin viewInserer -->