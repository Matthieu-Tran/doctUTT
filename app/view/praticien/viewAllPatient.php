<?php
require($root . '/app/view/fragment/fragmentHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">nom</th>
                    <th scope="col">prenom</th>
                    <th scope="col">Adresse</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listePatients as $patient) {
                    printf(
                        "<tr><td>%s</td><td>%s</td><td>%s</td></tr>",
                        $patient->getNom(),
                        $patient->getPrenom(),
                        $patient->getAdresse()
                    );
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- ----- fin viewAll -->