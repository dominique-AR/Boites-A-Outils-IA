<?php 

$ListeDomaine=[ [
    "nom" => "Domaine de connaissance", 
    "image" => "vendr_selctn_prcss.jpg",
    "lien" => "/domains"
], 
[
    "nom" => "Projets",
    "image" => "2614-4.jpg",
    "lien" => "/projects"
],
[
    "nom" => "Questions et Réponse",
    "image" => "depositphotos_283363562-stock-illustration-frequently-asked-questions-concept-question.jpg",
    "lien" => "/faqs"
]
];
echo view('templates/header'); ?>
<div class="container">
<h1 class="mb-4">FAQ - Foire aux Questions</h1>
        <p class="text-secondary">Aidez-nous à enrichir notre Foire aux Questions ! Si vous avez des questions, des projets ou des domaines qui ne sont pas encore abordés dans notre FAQ, ou si vous pensez que certaines informations pourraient bénéficier à d'autres utilisateurs, n'hésitez pas à contribuer. Vous pouvez soumettre vos questions et leurs réponses via le formulaire sur cette page.</p>
        <a href="#FAQ" class="btn btn-primary mb-4">Contribuer à la FAQ</a>
<h3>Questions et Réponse</h3>
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
                <a href="<?= site_url('faqs/edit/' . $faq['faq_id']) ?>" class="btn btn-success">Modifier</a>
                <a href="<?= 'faqs/delete/' . $faq['faq_id']?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette FAQ?');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Projets</h3>
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

<h3>Domaine de connaissance</h3>
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
    <!-- Domains, projects , FAQs -->
    <h1 id="FAQ">Créer une nouvelle thématique</h1>
    <div class="row w-100 p-3">
        <?php foreach($ListeDomaine as $domaine): ?>
        <div class="col-12 col-lg-4 my-2">
            <div class="card shadow">
                <!-- Correction du chemin de l'image -->
                <img src="<?= base_url("assets/images/". htmlspecialchars($domaine['image'])) ?>" class="card-img-top"
                    alt="Image of <?= htmlspecialchars($domaine['nom']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($domaine['nom']) ?></h5>
                    <!-- Correction de l'URL du bouton -->
                    <a href="<?= site_url(htmlspecialchars($domaine['lien'])) ?>" class="btn btn-success">Entrer</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- FIN Domains, projects , FAQs -->
</div>

<?php echo view('templates/footer'); ?>