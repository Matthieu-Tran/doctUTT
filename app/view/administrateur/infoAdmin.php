<!-- ----- début viewAllSpecialite -->
<div class="container p-5 mb-5">
    <h1>Liste des spécialités</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">label</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // La liste des vins est dans une variable $results             
            foreach ($listeSpecialites as $element) {
                printf(
                    "<tr><td>%d</td><td>%s</td></tr>",
                    $element->getId(),
                    $element->getLabel(),
                );
            }
            ?>
        </tbody>
    </table>
</div>
<!-- ----- fin viewAllSpecialite -->
<hr>

<div class="container p-5 mb-5">
    <h1>Liste des rendez vous</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">patient_id</th>
                <th scope="col">praticien_id</th>
                <th scope="col">rdv_date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // La liste des vins est dans une variable $results             
            foreach ($listeRendezVous as $element) {
                printf(
                    "<tr><td>%d</td><td>%d</td><td>%d</td><td>%s</td></tr>",
                    $element->getId(),
                    $element->getPatientId(),
                    $element->getPraticienId(),
                    $element->getRdvDate(),
                );
            }
            ?>
        </tbody>
    </table>
</div>

<hr>

<div class="container p-5 mb-5">
    <h1>Liste des praticiens</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Adresse</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // La liste des vins est dans une variable $results             
            foreach ($listePraticiens as $element) {
                printf(
                    "<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                    $element->getId(),
                    $element->getNom(),
                    $element->getPrenom(),
                    $element->getAdresse(),
                );
            }
            ?>
        </tbody>
    </table>
</div>

<hr>

<div class="container p-5 mb-5">
    <h1>Liste des patients</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Adresse</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // La liste des vins est dans une variable $results             
            foreach ($listePatients as $element) {
                printf(
                    "<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                    $element->getId(),
                    $element->getNom(),
                    $element->getPrenom(),
                    $element->getAdresse(),
                );
            }
            ?>
        </tbody>
    </table>
</div>

<hr>

<div class="container p-5 mb-5">
    <h1>Liste des administrateur</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Adresse</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // La liste des vins est dans une variable $results             
            foreach ($listeAdministrateurs as $element) {
                printf(
                    "<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                    $element->getId(),
                    $element->getNom(),
                    $element->getPrenom(),
                    $element->getAdresse(),
                );
            }
            ?>
        </tbody>
    </table>
</div>