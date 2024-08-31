<?php echo view('templates/header'); ?>
<div class="container">
<h1>Modifier le Projet</h1>
<form action="<?= site_url('projects/update/' . $project['project_id']) ?>" method="post" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="project_name" class="form-label">Nom du Projet:</label>
        <input type="text" class="form-control" id="project_name" name="project_name" value="<?= esc($project['project_name']) ?>" required>
        <div class="invalid-feedback">
            Veuillez entrer un nom de projet.
        </div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control" id="description" name="description" required><?= esc($project['description']) ?></textarea>
        <div class="invalid-feedback">
            Veuillez fournir une description.
        </div>
    </div>
    <div class="mb-3">
        <label for="domain_id" class="form-label">ID Domaine:</label>
        <select class="form-control" id="domain_id" name="domain_id" required>
        <option value="">Choisir un domaine</option>
        <?php foreach ($domains as $domain): ?>
            <option value="<?= $domain['domain_id'] ?>" <?= isset($project['domain_id']) && $project['domain_id'] == $domain['domain_id'] ? 'selected' : '' ?>>
                <?= esc($domain['domain_name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
        <div class="invalid-feedback">
            Veuillez fournir un ID de domaine valide.
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

</div>
<?php echo view('templates/footer'); ?>