<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UAS Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
</head>
<body style="background-color: #eef2f5;">

<div class="container">
    <div class="login-container">
        <div class="login-header">
            <h3><i class="fas fa-book-reader me-2"></i>CampusLib</h3>
            <p class="text-muted">Final Exam Project System</p>
        </div>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger py-2 text-center text-small">
                <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>auth/authenticate" method="POST">
            <div class="mb-3">
                <label class="form-label text-muted small fw-bold">USERNAME</label>
                <input type="text" name="username" class="form-control form-control-lg" placeholder="Enter username" required>
            </div>
            <div class="mb-4">
                <label class="form-label text-muted small fw-bold">PASSWORD</label>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn btn-primary-custom w-100 py-2 fw-bold">LOGIN</button>
            <div class="text-center mt-3">
                <small class="text-muted">Use: admin/123456 or user/123456</small>
            </div>
        </form>
    </div>
</div>

</body>
</html>