<!-- ----- début viewAll -->

<div class="container">
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
            foreach ($rdvsDisponibles as $rdv) {
                printf(
                    "<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                    $rdv->getId(),
                    $rdv->getPatientId(),
                    $rdv->getPraticienId(),
                    $rdv->getRdvDate()
                );
            }
            ?>
        </tbody>
    </table>
</div>

<!-- ----- fin viewAll -->