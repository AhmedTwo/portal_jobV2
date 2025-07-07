<div>

    <h1>DETAILS DE LA SOCIETE</h1>

    <?php
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) { // !is_numeric ???
        die("ID invalide ou non fourni !");
    }
    ?>

    <table id="datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Employés</th>
                <th>Secteur</th>
                <th>Adresse</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Description</th>
                <th>N° Siret</th>
                <th>Logo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $company["id"] ?></td>
                <td><?= htmlspecialchars($company["name"]) ?></td>
                <td><?= htmlspecialchars($company["number_of_employees"]) ?></td>
                <td><?= htmlspecialchars($company["industry"]) ?></td>
                <td><?= htmlspecialchars($company["address"]) ?></td>
                <td><?= htmlspecialchars($company["latitude"]) ?></td>
                <td><?= htmlspecialchars($company["longitude"]) ?></td>
                <td><?= nl2br(htmlspecialchars($company["description"])) ?></td>
                <td><?= htmlspecialchars($company["n_siret"]) ?></td>
                <td>
                    <a href="OfferCompany.php?id=<?= $company['id'] ?>">
                        <img src="<?= htmlspecialchars($company["logo"]) ?>" width="200" alt="Logo de la compagnie">
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>