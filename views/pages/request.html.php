<?php
$role = $_SESSION['new_role'] ?? null;
?>

<link rel="stylesheet" href="/assets/css/request.css">

<div class="main-content">

    <h1>TOUTES LES DEMANDES</h1>

    <br><br>

    <div class="cards-container">
        <?php foreach ($requests as $request): ?>
            <div class="card">
                <div class="card-header">
                    <div class="user-photo">
                        <?php if (!empty($request['user_id'])): ?>
                            <img src="<?= htmlspecialchars($request['user_photo']) ?>" alt="Photo Utilisateur">
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

                <?php if ($role === 'admin'): ?>
                    <div class="card-actions">
                        <form method="POST" action="/request/deleteRequest" onsubmit="return confirm('Es-tu sûr de vouloir supprimer cette demande ?');">
                            <input type="hidden" name="id" value="<?= $request['id'] ?>">
                            <button type="submit" class="btn-delete" title="Supprimer cette demande">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16" class="bi bi-trash-fill">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                            </button>
                        </form>

                        <form method="POST" action="/request/toggleStatus">
                            <input type="hidden" name="id" value="<?= $request['id'] ?>">
                            <input type="hidden" name="current_status" value="<?= $request['status'] ?>">
                            <button type="submit" class="btn-toggle" title="Changer le statut">
                                <?php if ($request['status'] === 'validée'): ?>
                                    <!-- Icône de retour à "en cours" -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                    </svg>
                                <?php else: ?>
                                    <!-- Icône de validation -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                    </svg>
                                <?php endif; ?>
                            </button>
                        </form>

                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div> <!-- /main-content -->