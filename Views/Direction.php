<?php
helper('fonction');

$host = 'localhost'; // par exemple, 'localhost' ou une adresse IP
$port = '5432'; // par défaut, PostgreSQL utilise le port 5432
$dbname = 'Tools';
$user = 'postgres';
$password = 'root';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";

try {
    // Crée une instance PDO pour la connexion
    $pdo = new PDO($dsn);

    if($pdo) {
        //echo "Connecté à la base de données $dbname avec succès!";

        //sql pour avoir le nombre des elements        
        $sqlCount = "SELECT COUNT(id) as total FROM promptIA WHERE cible = 'direction'";
        $stmtCount = $pdo->query($sqlCount);
        $resultscount = $stmtCount->fetch();
        //Nombre de page
        $pages = (int)ceil($resultscount['total']/3);
        //var_dump($pages);
        $page = empty($_GET["page"]) ? 1 : (int)$_GET["page"];
        //var_dump($page);

        //Point de depart
        $vers = empty($_GET['page'])||$_GET['page']==1 ? 0 : ($_GET['page']-1)*3;

        //requete par page
        $sql = "SELECT * FROM promptIA WHERE cible = 'direction' ORDER BY id OFFSET {$vers} LIMIT 3";
        $stmt = $pdo->query($sql);


        // Vérifie si la requête a réussi
        if($stmt) {
            // Récupère toutes les lignes de résultats comme un tableau
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        } else {
            echo "Erreur dans l'exécution de la requête.";
        }

    }
    

} catch (PDOException $e) {
    // Gère l'erreur de connexion
    die("Erreur de connexion : " . $e->getMessage());
}

?>

<!-- header -->
<?php echo view('templates/header'); ?>

<pre>
    <?php var_dump($resultscount['total']); ?>
</pre>

<!--début texte de présentation -->
<div class="container mt-5">
    <h2 class="mb-4">Objectifs des Prompts pour la Direction 🚀</h2>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-4">
            <!-- Liste de navigation pour le Scrollspy -->
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action" href="#list-item-1">Faciliter la Prise de Décision</a>
                <a class="list-group-item list-group-item-action" href="#list-item-2">Stimuler la Réflexion
                    Stratégique</a>
                <a class="list-group-item list-group-item-action" href="#list-item-3">Promouvoir l'Innovation</a>
                <a class="list-group-item list-group-item-action" href="#list-item-4">Renforcer les Compétences en
                    Leadership</a>
                <a class="list-group-item list-group-item-action" href="#list-item-5">Améliorer la Gestion du
                    Changement</a>
                <a class="list-group-item list-group-item-action" href="#list-item-6">Accroître l'Engagement des
                    Employés</a>
            </div>
        </div>
        <div class="col-8">
            <!-- Contenu à défiler avec Scrollspy -->
            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example"
                tabindex="0">
                <h4 id="list-item-1">Faciliter la Prise de Décision</h4>
                <p>Aider les dirigeants à naviguer à travers des décisions complexes en clarifiant les options et les
                    implications potentielles de chaque choix.</p>
                <h4 id="list-item-2">Stimuler la Réflexion Stratégique</h4>
                <p>Encourager les membres de la direction à penser à long terme et à considérer comment les actions
                    d'aujourd'hui affecteront l'avenir de l'organisation.</p>
                <h4 id="list-item-3">Promouvoir l'Innovation</h4>
                <p>Pousser les dirigeants à remettre en question le statu quo et à explorer de nouvelles idées pour
                    résoudre les problèmes ou saisir de nouvelles opportunités.</p>
                <h4 id="list-item-4">Renforcer les Compétences en Leadership</h4>
                <p>Développer les compétences interpersonnelles, la communication, et la capacité à inspirer et à
                    motiver les autres.</p>
                <h4 id="list-item-5">Améliorer la Gestion du Changement</h4>
                <p>Préparer les leaders à guider leurs équipes à travers des périodes de changement, en minimisant les
                    perturbations et en maximisant l'adaptabilité.</p>
                <h4 id="list-item-6">Accroître l'Engagement des Employés</h4>
                <p>En se concentrant sur la création d'un environnement de travail positif qui valorise la contribution
                    de chaque employé.</p>
            </div>
        </div>
    </div>
</div>


<!-- fin texte de présentation-->

<!-- Affichage des elements -->
<h1 class="container">Direction</h1>
<?php echo displayFrameworks($results)?>
<!-- fin Affichage des elements -->

<!-- systeme de pagination -->
<?php echo displayPagination($pages, $page, $_GET); ?>
<!--fin de systeme depagination  -->

<!-- footer -->
<?php echo view('templates/footer'); ?>