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
      $sqlCount = "SELECT COUNT(id) as total FROM promptIA WHERE cible = 'technique'";
      $stmtCount = $pdo->query($sqlCount);
      $resultscount = $stmtCount->fetch();
      //Nombre de page
      $pages = (int)ceil($resultscount['total']/5);
      //var_dump($pages);
      $page = empty($_GET["page"]) ? 1 : (int)$_GET["page"];
      //var_dump($page);

      //Point de depart
      $vers = empty($_GET['page'])||$_GET['page']==1 ? 0 : ($_GET['page'])*5;

      //requete par page
      $sql = "SELECT * FROM promptIA WHERE cible = 'technique' ORDER BY id OFFSET {$vers} LIMIT 5";
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
<!-- fin header -->

<div class="container mt-5">
    <h2 class="mb-4">Objectifs Clés pour l'Équipe Technique 🚀</h2>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-4">
            <!-- Liste de navigation pour le Scrollspy -->
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action" href="#list-item-1">Accroître l'Expertise
                    Technique</a>
                <a class="list-group-item list-group-item-action" href="#list-item-2">Amélioration de l'Infrastructure
                    IT</a>
                <a class="list-group-item list-group-item-action" href="#list-item-1">Intégration de la Technologie dans
                    la Prise de Décision</a>
                <a class="list-group-item list-group-item-action" href="#list-item-4">Automatisation des Processus</a>
                <a class="list-group-item list-group-item-action" href="#list-item-5">Collaboration
                    Interdépartementale</a>
                <a class="list-group-item list-group-item-action" href="#list-item-6">Innovation et Recherche
                    Technologique</a>
            </div>
        </div>
        <div class="col-8">
            <!-- Contenu à défiler avec Scrollspy -->
            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example"
                tabindex="0">
                <h4 id="list-item-1">Accroître l'Expertise Technique</h4>
                <p>Encourager la formation continue et le développement professionnel pour garantir que l'équipe possède
                    les compétences les plus avancées et pertinentes du secteur.</p>
                <h4 id="list-item-2">Amélioration de l'Infrastructure IT</h4>
                <p>Moderniser et optimiser l'infrastructure technologique pour soutenir efficacement les opérations de
                    l'entreprise et la croissance future.</p>
                <h4 id="list-item-1">Intégration de la Technologie dans la Prise de Décision</h4>
                <p>Utiliser les technologies pour analyser les données et fournir des insights qui soutiennent la prise
                    de décision stratégique au sein de l'équipe et de l'organisation.</p>
                <h4 id="list-item-4">Automatisation des Processus</h4>
                <p>Identifier et implémenter des solutions d'automatisation pour les tâches répétitives, afin
                    d'améliorer l'efficacité et de réduire les erreurs.</p>
                <h4 id="list-item-5">Collaboration Interdépartementale</h4>
                <p>Favoriser une collaboration étroite avec d'autres départements, comme les opérations, le marketing et
                    les ventes, pour aligner les initiatives technologiques avec les objectifs d'affaires.</p>
                <h4 id="list-item-6">Innovation et Recherche Technologique</h4>
                <p>Promouvoir un environnement où l'innovation est encouragée, en explorant de nouvelles technologies et
                    méthodologies pour maintenir l'entreprise à la pointe de son secteur.</p>
            </div>
        </div>
    </div>
</div>


<!-- Affichage des elements -->
<h1 class="container">Technique</h1>
<?php echo displayFrameworks($results)?>
<!-- fin Affichage des elements -->

<!-- systeme de pagination -->
<?php echo displayPagination($pages, $page, $_GET); ?>
<!--fin de systeme depagination  -->

<!-- footer -->
<?php echo view('templates/footer'); ?>