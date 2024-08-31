<?php echo view('templates/header'); ?>
<div class="container my-2">
<h1>Ajouter une FAQ</h1>
<form action="<?= site_url('faqs/createFaq') ?>" method="post">
    <div class="form-group">
        <label for="question">Question:</label>
        <input type="text" class="form-control" id="question" name="question" required>
    </div>
    <div class="form-group">
        <label for="answer">Réponse:</label>
        <textarea class="form-control" id="answer" name="answer" required></textarea>
    </div>
    <div class="form-group">
        <label for="project_id">Projet:</label>
        <select class="form-select" name="project_id" id="project_id" required>
            <?php foreach ($projects as $project): ?>
                <option value="<?= $project['project_id'] ?>">
                    <?= esc($project['project_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Soumettre</button>
</form>
</div>

<?php echo view('templates/footer'); ?>