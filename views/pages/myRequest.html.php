<?php
$role = $_SESSION['new_role'] ?? null;
?>

<link rel="stylesheet" href="/assets/css/request.css">

<div class="main-content">

    <h1>MES DEMANDES</h1>

    <div class="admin-add-request">
        <a href="myRequest/addMyRequest" class="btn-outline-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-plus-square" viewBox="0 0 16 16">
                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
            AJOUTER UNE DEMANDE
        </a>
    </div>

    <div class="cards-container">
        <?php foreach ($requests as $request): ?>
            <div class="card">
                <div class="card-header">
                    <div class="user-photo">
                        <?php if (!empty($request['user_id'])): ?>
                            <img src="<?= htmlspecialchars($request['photo']) ?>" alt="Photo Utilisateur">
                        <?php elseif (!empty($request['company_id'])): ?>
                            <img src="<?= htmlspecialchars($request['company_photo']) ?>" alt="Logo Entreprise">
                        <?php else: ?>
                            <div class="no-photo">--</div>
                        <?php endif; ?>
                    </div>
                    <h2 class="user-name">
                        <?= !empty($request['user_id'])
                            ? htmlspecialchars(($request['user_firstname'] ?? '') . ' ' . ($request['user_lastname'] ?? ''))
                            : htmlspecialchars($request['company_name'] ?? '--') ?>
                    </h2>
                </div>

                <div class="card-content">
                    <p><strong>Titre :</strong> <?= htmlspecialchars($request['title']) ?></p>
                    <p><strong>Description :</strong> <?= htmlspecialchars($request['description']) ?></p>
                    <p><strong>Type :</strong> <?= htmlspecialchars($request['type']) ?></p>
                    <p><strong>Statut :</strong> <?= htmlspecialchars($request['status']) ?></p>
                    <p><strong>Date de création :</strong> <?= htmlspecialchars($request['created_at']) ?></p>
                </div>

                <div class="card-actions">
                    <form method="POST" action="/myRequest/deleteRequest/" onsubmit="return confirm('Es-tu sûr de vouloir supprimer cette demande ?');">
                        <input type="hidden" name="id" value="<?= $request['id'] ?>">
                        <button type="submit" class="btn-delete" title="Supprimer cette demande">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 16 16" class="bi bi-trash-fill">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div> <!-- /main-content -->