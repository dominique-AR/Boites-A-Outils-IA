<?php
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
      $sqlCount = "SELECT COUNT(id) as total FROM promptIA WHERE cible = 'development'";
      $stmtCount = $pdo->query($sqlCount);
      $resultscount = $stmtCount->fetch();
      //Nombre de page
      $pages = (int)ceil($resultscount['total']/5);
      //var_dump($pages);
      $page = empty($_GET["page"]) ? 1 : (int)$_GET["page"];
      //var_dump($page);

      //Point de depart
      $vers = empty($_GET['page'])||$_GET['page']==1 ? 0 : ($_GET['page']-1)*5;

      //requete par page
      $sql = "SELECT * FROM promptIA WHERE cible = 'development' ORDER BY id OFFSET {$vers} LIMIT 5";
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

<div class="container mt-5">
    <h2 class="mb-4">Objectifs Clés pour l'Équipe de Développement 🚀</h2>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-4">
            <!-- Liste de navigation pour le Scrollspy -->
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action" href="#list-item-1">Amélioration des Méthodologies de
                    Développement</a>
                <a class="list-group-item list-group-item-action" href="#list-item-2">Optimisation de la
                    Collaboration</a>
                <a class="list-group-item list-group-item-action" href="#list-item-3">Innovation Technologique</a>
                <a class="list-group-item list-group-item-action" href="#list-item-4">Renforcement des Compétences
                    Techniques</a>
                <a class="list-group-item list-group-item-action" href="#list-item-5">Intégration Continue et
                    Déploiement Continu (CI/CD)</a>
                <a class="list-group-item list-group-item-action" href="#list-item-6">Amélioration de la Qualité du
                    Code</a>
            </div>
        </div>
        <div class="col-8">
            <!-- Contenu à défiler avec Scrollspy -->
            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example"
                tabindex="0">
                <h4 id="list-item-1">Amélioration des Méthodologies de Développement</h4>
                <p>Adopter et perfectionner des méthodologies agiles pour accélérer le cycle de développement, améliorer
                    la réactivité et favoriser une meilleure gestion de projet.</p>
                <h4 id="list-item-2">Optimisation de la Collaboration</h4>
                <p>Mettre en œuvre des outils et pratiques pour renforcer la collaboration entre les développeurs, les
                    designers, les testeurs et les gestionnaires de projet, en brisant les silos et en favorisant un
                    environnement de travail intégré.</p>
                <h4 id="list-item-3">Innovation Technologique</h4>
                <p>Encourager l'exploration et l'adoption de nouvelles technologies, langages de programmation et
                    frameworks pour rester à la pointe de l'innovation et améliorer les solutions développées.</p>
                <h4 id="list-item-4">Renforcement des Compétences Techniques</h4>
                <p>Investir dans la formation continue et le développement professionnel pour que l'équipe maîtrise les
                    dernières compétences techniques et meilleures pratiques de l'industrie.</p>
                <h4 id="list-item-5">Intégration Continue et Déploiement Continu (CI/CD)</h4>
                <p>Implémenter des pipelines CI/CD pour automatiser les tests et le déploiement, réduisant ainsi les
                    erreurs manuelles et accélérant le temps de mise sur le marché.</p>
                <h4 id="list-item-6">Amélioration de la Qualité du Code</h4>
                <p>Adopter des standards de codage élevés et utiliser des revues de code systématiques pour maintenir
                    une base de code propre, maintenable et sécurisée.</p>
            </div>
        </div>
    </div>
</div>


<!-- Affichage des elements -->
<h1 class="container">Development</h1>
<?php echo displayFrameworks($results)?>
<!-- fin Affichage des elements -->

<!-- systeme de pagination -->
<?php echo displayPagination($pages, $page, $_GET); ?>
<!--fin de systeme depagination  -->

<!-- footer -->
<?php echo view('templates/footer'); ?>