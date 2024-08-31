<?php echo view('templates/header'); ?>

<div class="container mt-2">
<h1>Liste des FAQ</h1>
<a href="<?= site_url('faqs/create') ?>" class="btn btn-success my-2">Ajouter une FAQ</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Question</th>
            <th>Réponse</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($faqs as $faq): ?>
        <tr>
            <td><?= esc($faq['question']) ?></td>
            <td><?= esc($faq['answer']) ?></td>
            <td>
                <a href="<?= site_url('faqs/edit/' . $faq['faq_id']) ?>" class="btn btn-primary">Modifier</a>
                <a href="<?= 'faqs/delete/' . $faq['faq_id']?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette FAQ?');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>



<?php echo view('templates/footer'); ?>
