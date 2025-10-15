<link rel="stylesheet" href="/assets/css/dashboard.css">

<br><br><br><br>
<div class="table-container">
    <table id="table-users">
        <h1 class="table-users-h1">LES UTILISATEURS</h1>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOM</th>
                <th>PRENOM</th>
                <th>EMAIL</th>
                <th>MOT DE PASSE</th>
                <th>RÔLE</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['nom']) ?></td>
                    <td><?= htmlspecialchars($user['prenom']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['password']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="/dashboard/updateUser/<?= $user['id'] ?>" title="Modifier">
                            <button type="submit" class="btn-details" style="background-color: transparent; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                </svg>
                            </button>
                        </a>
                        <form method="POST" action="/dashboard/deleteUser" onsubmit="return confirm('Es-tu sûr de vouloir supprimer cette société ?')" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button type="submit" class="btn-details" style="background-color: transparent; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<button class="voir-plus" data-target="users">Voir plus</button>

<div class="table-container">
    <table id="table-offers">
        <h1>LES OFFRES</h1>
        <thead>
            <tr>
                <th>ID</th>
                <th>TITRE</th>
                <th>ADRESSE</th>
                <th>DOMAINE</th>
                <th>DATE DE CREATION </th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offers as $offer): ?>
                <tr>
                    <td><?= htmlspecialchars($offer['id']) ?></td>
                    <td><?= htmlspecialchars($offer['title']) ?></td>
                    <td><?= htmlspecialchars($offer['location']) ?></td>
                    <td><?= htmlspecialchars($offer['category']) ?></td>
                    <td><?= htmlspecialchars(date('d-M-Y', strtotime($offer['created_at']))) ?></td>
                    <!--strtotime() convertit la chaîne SQL en timestamp UNIX soit en une date formatée lisible-->
                    <td>
                        <a href="/offers/offerDetails/<?= $offer['id'] ?>" title="Détails">
                            <button type="submit" class="btn-details" style="background-color: transparent; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                </svg>
                            </button>
                        </a>
                        <a href="/offers/updateOffer/<?= $offer['id'] ?>" title="Modifier">
                            <button type="submit" class="btn-details" style="background-color: transparent; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                </svg>
                            </button>
                        </a>
                        <form method="POST" action="/offers/deleteOffer" onsubmit="return confirm('Es-tu sûr de vouloir supprimer cette société ?')" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $offer['id'] ?>">
                            <button type="submit" class="btn-details" style="background-color: transparent; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<button class="voir-plus" data-target="offers">Voir plus</button>

<div class="table-container">
    <table id="table-companies">
        <h1>LES SOCIÉTÉS</h1>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOM</th>
                <th>ADRESSE</th>
                <th>DOMAINE</th>
                <th>N° SIRET</th>
                <th>STATUS</th>
                <th>ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companys as $company): ?>
                <tr>
                    <td><?= htmlspecialchars($company['id']) ?></td>
                    <td><?= htmlspecialchars($company['name']) ?></td>
                    <td><?= htmlspecialchars($company['address']) ?></td>
                    <td><?= htmlspecialchars($company['industry']) ?></td>
                    <td><?= htmlspecialchars($company['n_siret']) ?></td>
                    <td>
                        <form method="POST" action="/dashboard/toggleStatus" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $company['id'] ?>">
                            <input type="hidden" name="current_status" value="<?= $company['status'] ?>">
                            <button type="submit" class="btn-toggle">
                                <?= htmlspecialchars($company['status']) ?>
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="/company/companyDetails/<?= $company['id'] ?>" title="Détails">
                            <button type="submit" class="btn-details" style="background-color: transparent; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                </svg>
                            </button>
                        </a>
                        <a href="/company/updateCompany/<?= $company['id'] ?>" title="Modifier">
                            <button type="submit" class="btn-details" style="background-color: transparent; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                </svg>
                            </button>
                        </a>
                        <form method="POST" action="/company/deleteCompany" onsubmit="return confirm('Es-tu sûr de vouloir supprimer cette société ?')" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $company['id'] ?>">
                            <button type="submit" class="btn-details" style="background-color: transparent; cursor: pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<button class="voir-plus" data-target="companies">Voir plus</button>

<script>
    // Attend que le DOM soit complètement chargé avant d'exécuter le code
    document.addEventListener("DOMContentLoaded", () => {

        // Tableau de configuration pour gérer les 3 tableaux : users, offers et companies
        const config = [{
                id: "table-users", // ID du tableau HTML pour les utilisateurs
                buttonTarget: "users" // Attribut data-target du bouton "voir plus" correspondant
            },
            {
                id: "table-offers", // ID du tableau HTML pour les offres
                buttonTarget: "offers"
            },
            {
                id: "table-companies", // ID du tableau HTML pour les entreprises
                buttonTarget: "companies"
            }
        ];

        // Boucle sur chaque configuration pour initialiser le comportement "voir plus"
        config.forEach(({
            id,
            buttonTarget
        }) => {

            // Récupère le tableau correspondant à l'ID
            const table = document.getElementById(id);
            if (!table) return; // Si le tableau n'existe pas, on arrête cette itération

            // Récupère toutes les lignes de ce tableau (dans tbody)
            const rows = Array.from(table.querySelectorAll("tbody tr"));

            // Récupère le bouton "voir plus" qui correspond à ce tableau via data-target
            const btn = document.querySelector(`.voir-plus[data-target="${buttonTarget}"]`);

            // Nombre initial de lignes visibles
            let visibleCount = 4;

            // Fonction pour afficher uniquement les lignes visibles
            const updateVisibility = () => {
                rows.forEach((row, index) => {
                    // Affiche les lignes dont l’index est inférieur à visibleCount
                    row.style.display = index < visibleCount ? "table-row" : "none";
                });

                // Cache le bouton si toutes les lignes sont déjà affichées
                if (visibleCount >= rows.length) {
                    btn.style.display = "none";
                }
            };

            // Exécute une première fois pour cacher les lignes en trop
            updateVisibility();

            // Quand on clique sur "voir plus", on augmente le nombre de lignes visibles
            btn.addEventListener("click", () => {
                visibleCount += 4; // Affiche 4 lignes de plus à chaque clic
                updateVisibility(); // Met à jour l'affichage des lignes
            });
        });
    });
</script>