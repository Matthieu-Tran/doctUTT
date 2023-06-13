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
            foreach ($results as $element) {
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