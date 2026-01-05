<div class="row">
    <div class="col-12 mb-4">
        <div class="card custom-card bg-white p-4">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary me-3">
                    <i class="fas fa-book-open fa-2x"></i>
                </div>
                <div>
                    <h2 class="h4 mb-0">Welcome back, <?= htmlspecialchars(ucfirst($_SESSION['username'])) ?>!</h2>
                    <p class="text-muted mb-0">You are logged in as a <strong><?= ucfirst($_SESSION['role']) ?></strong>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card custom-card h-100">
            <div class="card-body">
                <h5 class="card-title text-primary"><i class="fas fa-rocket me-2"></i>Quick Actions</h5>
                <p class="card-text text-muted">Manage the library database efficiently.</p>
                <div class="d-grid gap-2">
                    <a href="<?= BASE_URL ?>book" class="btn btn-outline-primary"><i class="fas fa-search me-2"></i>Browse Books</a>
                    <?php if($_SESSION['role'] === 'admin'): ?>
                        <a href="<?= BASE_URL ?>book/create" class="btn btn-primary-custom"><i class="fas fa-plus me-2"></i>Add New Book</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php if($_SESSION['role'] === 'admin'): ?>
    <div class="col-md-6">
        <div class="card custom-card h-100">
            <div class="card-body">
                <h5 class="card-title text-success"><i class="fas fa-info-circle me-2"></i>System Info</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        Database Status <span class="badge bg-success rounded-pill">Connected</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        PHP Version <span class="text-muted"><?= phpversion() ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0">
                        Server Port <span class="text-muted">8111</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>