<br>
<h1>TOUTES LES SOCIETEES</h1>

<!-- isset permet de verifier si sa existe
    soit ici sa verifie si un utilisateur est connecté ($_SESSION['new_role'] existe)
    et qu'il a le rôle d'admin alors sa affiche le bloc qui l'entoure -->
<br>
        <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'): ?>
            <div class="mb-4">
                <a href="addCompanys.php" class="btn btn-outline-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-plus-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                    AJOUTER UNE SOCIETE
                </a>
            </div>
        <?php endif; ?>

            <br><br>
        <table id="idTable" class="display table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>LOGO SOCIETE</th>
                    <th>NOM SOCIETE</th>
                    <th>SECTEUR</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($company as $company): ?>
                    <tr>
                        <td>
                            <a href="OfferCompany.php?id=<?= $company['id'] ?>">
                                <img src="<?= $company['logo'] ?>" width="100" alt="Logo de l'entreprise">
                            </a>
                        </td>
                        <td><?= htmlspecialchars($company['name']) ?></td>
                        <td><?= htmlspecialchars($company['industry']) ?></td>
                        <td>
                            <!-- Détails -->
                            <a href="companyDetails.php?id=<?= $company['id'] ?>" class="btn btn-success" title="Détails">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                            <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            </svg>
                            </a>
                            
                            <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'): ?>
                                <!-- Modifier -->
                                <a href="updateCompany.php?idC=<?= $company['id'] ?>" class="btn btn-primary" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                    </svg>
                                </a>
                                <!-- Supprimer -->
                                <a href="../../includes/delete.php?idC=<?= $company['id'] ?>"
                                    class="btn btn-danger"
                                    title="Supprimer"
                                    onclick="return confirm('Es-tu sûr de vouloir supprimer cette compagnie ?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>