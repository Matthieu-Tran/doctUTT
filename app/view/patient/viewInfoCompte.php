<div class="container">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">nom</th>
                <th scope="col">prenom</th>
                <th scope="col">adresse</th>
                <th scope="col">login</th>
                <th scope="col">password</th>
                <th scope="col">statut</th>
                <th scope="col">spécialité</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($results as $info) {
                printf(
                    "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                    $info->getId(),
                    $info->getNom(),
                    $info->getPrenom(),
                    $info->getAdresse(),
                    $info->getLogin(),
                    $info->getPassword(),
                    $info->getStatut(),
                    $info->getSpecialiteId()
                );
            }
            ?>
        </tbody>
    </table>
</div>

<!-- ----- fin viewAll -->