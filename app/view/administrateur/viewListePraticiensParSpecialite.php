<!-- ----- début viewAll -->
<div class="container p-5">
    <h1>Liste des praticiens (Générique)</h1>
    <table class="table table-striped table-bordered">

        <thead>
            <tr>
                <?php
                $attributes = $results['attributes'];
                $tuples = $results['tuples'];
                foreach ($attributes as $attribute) {
                    echo "<th scope='col'>" . $attribute . "</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // La liste des vins est dans une variable $results  
            foreach ($tuples as $tuple) {
                echo "<tr>";
                foreach ($tuple as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- ----- fin viewAll -->