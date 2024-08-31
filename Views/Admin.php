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
      $sqlCount = "SELECT COUNT(id) as total FROM promptIA";
      $stmtCount = $pdo->query($sqlCount);
      $resultscount = $stmtCount->fetch();
      //Nombre de page
      $pages = (int)ceil($resultscount['total']/5);
      $page = empty($_GET["page"]) ? 1 : (int)$_GET["page"];

      //Point de depart
      $vers = empty($_GET['page'])||$_GET['page']==1 ? 0 : ($_GET['page']-1)*5;

      //requete par page
      $sql = "SELECT * FROM promptIA ORDER BY id OFFSET {$vers} LIMIT 5";
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
    <h2 class="mb-4">Objectifs Clés pour l'Administration 🚀</h2>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-4">
            <!-- Liste de navigation pour le Scrollspy -->
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action" href="#list-item-1">Amélioration de la Communication
                    Interne</a>
                <a class="list-group-item list-group-item-action" href="#list-item-2">Gestion Optimale des
                    Ressources</a>
                <a class="list-group-item list-group-item-action" href="#list-item-3">Développement du Leadership
                    Administratif</a>
                <a class="list-group-item list-group-item-action" href="#list-item-4">Innovation dans les Processus
                    Administratifs</a>
                <a class="list-group-item list-group-item-action" href="#list-item-5">Renforcement de la Culture
                    Organisationnelle</a>
                <a class="list-group-item list-group-item-action" href="#list-item-6">Amélioration de l'Efficiacité
                    Opérationnelle</a>
            </div>
        </div>
        <div class="col-8">
            <!-- Contenu à défiler avec Scrollspy -->
            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example"
                tabindex="0">
                <h4 id="list-item-1">Amélioration de la Communication Interne</h4>
                <p>Mettre en place des stratégies et des outils pour renforcer la communication entre les différents
                    niveaux et départements de l'organisation, facilitant ainsi une meilleure collaboration et une
                    compréhension commune des objectifs.</p>
                <h4 id="list-item-2">Gestion Optimale des Ressources</h4>
                <p>Utiliser des techniques de gestion avancées pour optimiser l'utilisation des ressources matérielles,
                    financières et humaines, en vue d'accroître l'efficacité et de réduire les coûts.</p>
                <h4 id="list-item-3">Développement du Leadership Administratif</h4>
                <p>Former et développer les compétences de leadership chez les administrateurs pour qu'ils puissent
                    diriger efficacement, prendre des décisions éclairées et inspirer leurs équipes.</p>
                <h4 id="list-item-4">Innovation dans les Processus Administratifs</h4>
                <p>Encourager l'adoption de nouvelles technologies et méthodologies pour moderniser et automatiser les
                    processus administratifs, améliorant ainsi la productivité et la prestation de services.</p>
                <h4 id="list-item-5">Renforcement de la Culture Organisationnelle</h4>
                <p>Construire une culture organisationnelle forte et cohérente qui valorise l'intégrité, le respect,
                    l'innovation et l'excellence, en alignant les valeurs de l'organisation avec les actions de chaque
                    employé.</p>
                <h4 id="list-item-6">Amélioration de l'Efficiacité Opérationnelle</h4>
                <p>Identifier et implémenter des améliorations continues dans les opérations pour augmenter
                    l'efficacité, réduire les délais de traitement et améliorer la qualité des services offerts aux
                    usagers.</p>
            </div>
        </div>
    </div>
</div>


<!-- Affichage des elements -->
<?php echo tableauDesElements($results); ?>
<!-- fin Affichage des elements -->

<!-- systeme de pagination -->
<?php echo displayPagination($pages, $page, $_GET); ?>
<!--fin de systeme depagination  -->

<!-- footer -->
<?php echo view('templates/footer'); ?>