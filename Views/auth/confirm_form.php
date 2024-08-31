<?php echo view('templates/header'); ?>
<!-- confirm_form.php -->
<div class="container">
    <h1>Confirm Registration</h1>
    <form method="post" action="<?= site_url('/auth/finalizeRegistration'); ?>">
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Admin</h5>
                <div class="card-body">
                    <!-- Affichage des messages d'erreur -->
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Formulaire de connexion -->
                    <form method="post" action="<?= site_url('auth/login'); ?>">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Confirmation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </form>
</div>
<?php echo view('templates/footer'); ?>