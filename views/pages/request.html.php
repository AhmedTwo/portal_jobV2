    <br>
    <h1>TOUTES LES DEMANDES</h1>

    <a href="/addRequest.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
        </svg>
        Ajouter une demande
    </a>
    </div>

    <table id="idTable">
        <thead>
            <tr>
                <th>NAME</th>
                <th>PHOTO</th>
                <th>TITLE</th>
                <th>DESCRIPTION</th>
                <th>TYPE</th>
                <th>STATUS</th>
                <th>DATE DE CREATION</th>
                <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'): ?>
                    <th>ACTION</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requests as $request): ?>
                <tr>
                    <!-- Dans le HTML, je peux afficher une valeur par défaut (comme "--") si la donnée est vide : -->
                    <td>
                    <?= !empty($request['user_id']) 
                    ? htmlspecialchars(($request['user_firstname'] ?? '') . ' ' . ($request['user_lastname'] ?? '')) 
                    : htmlspecialchars($request['company_name'] ?? '') ?>
                    </td>
                    <td>
                    <?php if (!empty($request['user_id'])): ?>
                    <img src="<?= htmlspecialchars($request['user_photo']) ?>" width="100" alt="Photo Utilisateur">
                    <?php elseif (!empty($request['company_id'])): ?>
                    <img src="<?= htmlspecialchars($request['company_photo']) ?>" width="100" alt="Logo Entreprise">
                    <?php else: ?>
                     --
                    <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($request['title']) ?></td>
                    <td><?= htmlspecialchars($request['description']) ?></td>
                    <td><?= htmlspecialchars($request['type']) ?></td>
                    <td><?= htmlspecialchars($request['status']) ?></td>
                    <td><?= htmlspecialchars($request['created_at']) ?></td>
                    <?php if (isset($_SESSION['new_role']) && $_SESSION['new_role'] === 'admin'): ?>
                        <td>
                            <!-- Supprimer -->
                            <a href="../../includes/delete.php?idD=<?= $request['id'] ?>" class="btn btn-danger"
                                onclick="return confirm('Es-tu sûr de vouloir supprimer cette demande ?')" title="Supprimer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>