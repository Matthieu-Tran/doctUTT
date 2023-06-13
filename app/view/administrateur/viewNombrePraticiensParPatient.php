<!-- ----- début viewAll -->
<div class="container p-5">
    <h1>Nombre de praticiens par patient (Générique)</h1>
    <table class="table table-striped table-bordered">

        <thead>
            <tr>
                <th scope="col">Patient</th>
                <th scope="col">Nombre de praticiens</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $patientNames = $results['patient_name'];
            $nbPraticiens = $results['nombre_praticiens'];
            for ($i = 0; $i < count($patientNames); $i++) {
                echo "<tr>";
                echo "<td>" . $patientNames[$i] . "</td>";
                echo "<td>" . $nbPraticiens[$i] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- ----- fin viewAll -->