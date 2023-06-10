<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentMenu.html';
        include $root . '/app/view/fragment/fragmentJumbotron.html';
        ?>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">idRdv</th>
                    <th scope="col">nomPraticien</th>
                    <th scope="col">prenomPraticien</th>
                    <th scope="col">DateRdv</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $res) {
                    printf(
                        "<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                        $res['id'],
                        $res['nom'],
                        $res['prenom'],
                        $res['rdv_date']
                    );
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- ----- fin viewAll -->