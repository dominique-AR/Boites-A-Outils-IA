<?php echo view('templates/header'); ?>
<div class="container">
    <!-- app/Views/domains/index.php -->
<h1>Liste des Domaines</h1>
<a href="<?= site_url('domains/create') ?>" class="btn btn-primary my-1">Ajouter un Domaine</a>
<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($domains as $domain): ?>
        <tr>
            <td><?= esc($domain['domain_name']) ?></td>
            <td><?= esc($domain['description']) ?></td>
            <td class="d-flex flex-row">
                <a href="<?= site_url('domains/edit/' . $domain['domain_id']) ?>" class="btn btn-success mx-1">Modifier</a>
                <form action="<?= site_url('domains/delete/' . $domain['domain_id']) ?>" method="post" style="display:inline-block;">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce domaine ?');">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
<?php echo view('templates/footer'); ?>