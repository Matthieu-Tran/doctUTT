<!-- ----- début viewInsert -->

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<div class="container rounded" style="max-width: 500px;">
    <div class="card-body">
        <form role="form" method="POST" action="router.php?action=rdvCreated">
            <div class="form-group">
                <input type="hidden" name='action' value='rdvCreated'>
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" min="<?php date_default_timezone_set('Europe/Paris');
                                                                echo date('Y-m-d'); ?>" size='75' required><br>

                <label for="nombre_rdv">Nombre de rendez-vous :</label>
                <input type="number" id="nombre_rdv" name="nombre_rdv" min="1" max="9" size='75' required><br>
            </div>
            <p />
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
    </div>
</div>



<!-- ----- fin viewInsert -->