<?php echo view('templates/header'); ?>
<div class="container">
    <!-- app/Views/domains/edit.php -->
<h1>Modifier le Domaine</h1>
<form action="<?= site_url('domains/update/' . $domain['domain_id']) ?>" method="post">
    <div class="mb-3">
        <label for="domain_name" class="form-label">Nom du Domaine:</label>
        <input type="text" class="form-control" id="domain_name" name="domain_name" value="<?= esc($domain['domain_name']) ?>" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description" name="description"><?= esc($domain['description']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

</div>
<?php echo view('templates/footer'); ?>