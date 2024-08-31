<?php echo view('templates/header'); ?>
<div class="container">
    <!-- app/Views/domains/create.php -->
<h1>Ajouter un Domaine</h1>
<form action="<?= site_url('domains/store') ?>" method="post">
    <div class="mb-3">
        <label for="domain_name" class="form-label">Nom du Domaine:</label>
        <input type="text" class="form-control" id="domain_name" name="domain_name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

</div>
<?php echo view('templates/footer'); ?>