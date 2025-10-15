<link rel="stylesheet" href="/assets/css/companyDetails.css">

<div class="main">
    <h1 class="title-h1">DÉTAILS DE LA SOCIÉTÉ</h1>

    <div class="table-container">
        <table id="company-table" class="table responsive-table">
            <thead>
                <tr>
                    <th class="col">ID</th>
                    <th class="col">Nom</th>
                    <th class="col">Employés</th>
                    <th class="col">Secteur</th>
                    <th class="col">Adresse</th>
                    <th class="col">Latitude</th>
                    <th class="col">Longitude</th>
                    <th class="col">Description</th>
                    <th class="col">N° Siret</th>
                    <th class="col">Logo</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="cell-id"><?= $company["id"] ?></td>
                    <td class="cell-name"><?= htmlspecialchars($company["name"]) ?></td>
                    <td class="cell-employees"><?= htmlspecialchars($company["number_of_employees"]) ?></td>
                    <td class="cell-sector"><?= htmlspecialchars($company["industry"]) ?></td>
                    <td class="cell-address"><?= htmlspecialchars($company["address"]) ?></td>
                    <td class="cell-lat"><?= htmlspecialchars($company["latitude"]) ?></td>
                    <td class="cell-lng"><?= htmlspecialchars($company["longitude"]) ?></td>
                    <td class="cell-desc"><?= nl2br(htmlspecialchars($company["description"])) ?></td>
                    <td class="cell-siret"><?= htmlspecialchars($company["n_siret"]) ?></td>
                    <td class="cell-logo">
                        <a href="/offers/offerCompany/<?= $company['id'] ?>" class="logo-link">
                            <img src="<?= htmlspecialchars($company["logo"]) ?>" alt="Logo de la compagnie" class="logo-img">
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>