<?php 
$departments = [
    'development' => 'development',
    'administration' => 'administration',
    'technique' => 'technique',
    'direction' => 'direction',
    'marketing_digital' => 'marketing digital',
    'smqe' => 'smqe',
    'sig' => 'sig'
];
echo view('templates/header'); ?>
<div class="container">
<h1>Edité un promptIA</h1>

<form method="post" action="<?= site_url('promptia/edit/' . $promptia['id']) ?>" class="p-3">
    <div class="form-group">
        <label for="activites">Activités:</label>
        <input type="text" name="activites" id="activites" class="form-control" value="<?= esc($promptia['activites']) ?>" required>
    </div>

    <div class="form-group">
        <label for="taches">Tâches:</label>
        <input type="text" name="taches" id="taches" class="form-control" value="<?= esc($promptia['taches']) ?>" required>
    </div>

    <div class="form-group">
        <label for="outils">Outils:</label>
        <input type="text" name="outils" id="outils" class="form-control" value="<?= esc($promptia['outils']) ?>" required>
    </div>

    <div class="form-group">
        <label for="framework">Framework:</label>
        <input type="text" name="framework" id="framework" class="form-control" value="<?= esc($promptia['framework']) ?>" required>
    </div>

    <div class="form-group">
        <label for="prompt">Prompt:</label>
        <textarea name="prompt" id="prompt" class="form-control" required><?= esc($promptia['prompt']) ?></textarea>
    </div>

    <div class="form-group">
        <label for="actions">Actions:</label>
        <textarea name="actions" id="actions" class="form-control" required><?= esc($promptia['actions']) ?></textarea>
    </div>

    <div class="form-group">
        <label for="resultats">Résultats:</label>
        <textarea name="resultats" id="resultats" class="form-control" required><?= esc($promptia['resultats']) ?></textarea>
    </div>

    <div class="form-group">
    <label for="cible">Cible:</label>
    <select name="cible" id="cible" class="form-control" required>
        <?php foreach ($departments as $key => $value): ?>
            <option value="<?= htmlspecialchars($key) ?>" <?= $key == esc($promptia['cible']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($value) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

</div>
<?php echo view('templates/footer'); ?>