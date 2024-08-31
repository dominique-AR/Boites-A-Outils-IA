<?php echo view('templates/header'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Login</h5>
                <div class="card-body">
                    <!-- Affichage des messages de succès -->
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Affichage des messages d'erreur -->
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
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
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                    <!-- Lien pour la création de compte -->
                    <div class="mt-3">
                        <a href="<?= site_url('auth/register'); ?>" class="btn btn-secondary">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo view('templates/footer'); ?>