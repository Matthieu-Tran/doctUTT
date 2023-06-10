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
                    <th scope="col">rdv_date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($rdvsPraticien as $rdv) {
                    $patientNom = ModelPersonne::getOne($rdv->getPatientId());
                    printf(
                        "<tr><td>%s</td><td>%s</td><td>%s</td></tr>",
                        $patientNom->getNom(),
                        $patientNom->getPrenom(),
                        $rdv->getRdvDate()
                    );
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- ----- fin viewAll -->