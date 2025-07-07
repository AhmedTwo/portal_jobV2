<div class="flex-grow-1 p-4">
    <div class="row">
        <?php require_once '../../includes/Dashboard.php'; ?>
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Utilisateurs</h5>
                    <p class="card-text"><?php echo count($usersAll); ?> Utilisateurs inscrits</p>
                    <i class="fa fa-users fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Offres job</h5>
                    <p class="card-text"><?php echo count($offreAll); ?> Offres</p>
                    <i class="fa fa-briefcase fa-2x"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Compagnies</h5>
                    <p class="card-text"><?php echo count($companyAll); ?> Compagnies</p>
                    <i class="fa fa-building fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>