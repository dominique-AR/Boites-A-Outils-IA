<?php echo view('templates/header'); ?>
<div class="container mt-5">
    <h1 class="mb-3">User Registration</h1>
    <!-- Affichage des messages d'erreur -->
    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
    <?php endif; ?>

    <!-- Formulaire d'inscription -->
    <form method="post" action="<?= site_url('/auth/register'); ?>">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" class="form-control" required>
                <option value="administrateur">administrateur</option>
                <option value="utilisateur">utilisateur</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<?php echo view('templates/footer'); ?>