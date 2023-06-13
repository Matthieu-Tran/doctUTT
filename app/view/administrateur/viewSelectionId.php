<div class="container p-5">
    <h1>Choisissez l'ID de la spécialité</h1>

    <form role="form" method='get' action='router.php'>
        <div class="form-group">
            <input type="hidden" name='action' value='<?php echo ($target); ?>'>
            <label for="id">id : </label> <select class="form-control" id='id' name='id' style="width: 100px">
                <?php
                foreach ($results as $id) {
                    echo ("<option>$id</option>");
                }
                ?>
            </select>
        </div>
        <p /><br />
        <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
    <p />
</div>