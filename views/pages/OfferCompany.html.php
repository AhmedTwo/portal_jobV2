<div class="container">
    <br><br><br><br><br>
    <h1>OFFRES DE LA COMPAGNIE</h1>

    <?php
    if (!isset($_GET['id'])) {
        die("Offre introuvable !");
    }

    if (!$company) {
        die("Offre non trouvée !");
    }
    ?>

    <table id="datatable" class="display">
        <thead>
            <tr>
                <th>COMPAGNIE</th>
                <th>NAME</th>
                <th>NB EMPLOYE</th>
                <th>DOMAINE</th>
                <th>ADRESSE</th>
                <th>DESCRIPTION</th>
                <th>NOMBRE D'OFFRE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <img src="<?php echo $company["logo"]; ?>" width="100">
                </td>
                <td><?php echo $company["name"]; ?></td>
                <td><?php echo $company["number_of_employees"]; ?></td>
                <td><?php echo $company["industry"]; ?></td>
                <td><?php echo $company["address"]; ?></td>
                <td><?php echo $company["description"]; ?></td>
                <td><?php echo count($offers); ?></td>
            </tr>

        </tbody>
    </table>

    <table id="idTable" class="display">
        <thead>
            <tr>
                <th>TITRE</th>
                <th>CONTRAT</th>
                <th>IMAGE</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offers as $ligne): ?>
                <tr>
                    <td><?= $ligne['title'] ?></td>
                    <td><?= $ligne['contrat'] ?></td>
                    <td>
                        <img src="<?= $ligne['image_url'] ?>" width="200" alt="Image de l'offre">
                    </td>
                    <td>
                        <a href="OfferDetails.php?id=<?= $ligne['id'] ?>" title="Voir les détails">
                            Voir détail
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

    <?php
    if (!$offers) {
        echo "<h1>COMPAGNIE SANS OFFRE !</h1>";
    }
    ?>

</div>