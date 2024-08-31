<?php echo view('templates/header'); ?>
<div class="container my-2">
<a href="<?= site_url('projects/create') ?>" class="btn btn-primary mb-3">Ajouter un Projet</a>

<table class="table">
    <thead>
        <tr>
            <th>Nom du Projet</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project) : ?>
            <tr>
                <td><?= esc($project['project_name']) ?></td>
                <td><?= esc($project['description']) ?></td>
                <td>
                    <a href="<?= site_url('projects/edit/' . $project['project_id']) ?>" class="btn btn-success"> Modifier </a>
                    <form  method="POST" action="<?= site_url('projects/delete/' . $project['project_id']) ?>" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php echo view('templates/footer'); ?>