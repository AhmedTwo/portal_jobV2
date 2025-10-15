<link rel="stylesheet" href="/assets/css/offerCompany.css">

<div class="container">
    <br><br><br><br><br>

    <h1>↓ DETAILS DE LA SOCIETEE ↓</h1>

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
            <?php if (is_array($company)): ?>
                <tr>
                    <td>
                        <img src="<?php echo $company["logo"]; ?>" width="100">
                    </td>
                    <td><?php echo $company["name"]; ?></td>
                    <td><?php echo $company["number_of_employees"]; ?></td>
                    <td><?php echo $company["industry"]; ?></td>
                    <td><?php echo $company["address"]; ?></td>
                    <td><?php echo $company["description"]; ?></td>
                    <td><?php echo is_array($offers) ? count($offers) : 0; ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="7">Erreur : données de la société non disponibles.</td>
                </tr>
            <?php endif; ?>


        </tbody>
    </table>

    <h1>↓ OFFRES DE LA SOCIETEE ↓</h1>

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
                        <!-- le premier / est important pour indiquer un chemin absolu -->
                        <a href="/offers/offerDetails/<?= $ligne['id'] ?>" title="Voir les détails">
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