<?php echo view('templates/header'); ?>

<div class="container">
<h1>Modifier la FAQ</h1>
<form method="post" action="<?= site_url('faqs/update/' . $faq['faq_id']) ?>" class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="question" class="form-label">Question</label>
        <input type="text" class="form-control" name="question" id="question" value="<?= esc($faq['question']) ?>" required>
        <div class="invalid-feedback">
            Veuillez entrer une question.
        </div>
    </div>
    <div class="mb-3">
        <label for="answer" class="form-label">Réponse</label>
        <textarea class="form-control" name="answer" id="answer" rows="3" required><?= esc($faq['answer']) ?></textarea>
        <div class="invalid-feedback">
            Veuillez fournir une réponse.
        </div>
    </div>
    <div class="mb-3">
        <label for="project_id" class="form-label">ID du Projet</label>
        <select class="form-select" name="project_id" id="project_id" required>
            <?php foreach ($projects as $project): ?>
                <option value="<?= $project['project_id'] ?>" <?= ($project['project_id'] == $faq['project_id']) ? 'selected' : '' ?>>
                    <?= esc($project['project_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
            Veuillez sélectionner un projet.
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
</div>


<?php echo view('templates/footer'); ?>