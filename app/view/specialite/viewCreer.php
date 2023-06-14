<!-- ----- début viewCreer -->
<div class="label-form" style="min-height: 80vh; margin-top: 100px;">
    <?php
    if (isset($_GET['label_err'])) {
    ?>
        <div class="alert alert-danger">
            <strong>Erreur</strong> La spécialité existe déjà !
        </div>

    <?php

    }
    ?>
    <div class="container p-5">
        <form role="form" method='get' action='router.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='specialiteInserer'>
                <label class='w-25' for="id">Label : </label><input type="text" name='label' size='75'><br />
            </div>
            <p />
            <br />
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        <p />
    </div>
</div>

<!-- ----- fin viewCreer -->