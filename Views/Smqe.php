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
      $sqlCount = "SELECT COUNT(id) as total FROM promptIA WHERE cible = 'dsmqe'";
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
      $sql = "SELECT * FROM promptIA WHERE cible = 'smqe' ORDER BY id OFFSET {$vers} LIMIT 5";
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
    <h2 class="mb-4">Objectifs Clés pour l'Équipe SMQE 🚀</h2>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-4">
            <!-- Liste de navigation pour le Scrollspy -->
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action" href="#list-item-1">Renforcement de la Sécurité au
                    Travail</a>
                <a class="list-group-item list-group-item-action" href="#list-item-2">Amélioration Continue des
                    Méthodes</a>
                <a class="list-group-item list-group-item-action" href="#list-item-1">Intégration de la Technologie dans
                    la Prise de Décision</a>
                <a class="list-group-item list-group-item-action" href="#list-item-4">Contrôle Qualité et Conformité</a>
                <a class="list-group-item list-group-item-action" href="#list-item-5">Engagement pour la Responsabilité
                    Environnementale</a>
                <a class="list-group-item list-group-item-action" href="#list-item-6">Optimisation de l'Efficiacité
                    Opérationnelle</a>
            </div>
        </div>
        <div class="col-8">
            <!-- Contenu à défiler avec Scrollspy -->
            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example"
                tabindex="0">
                <h4 id="list-item-1">Renforcement de la Sécurité au Travail</h4>
                <p>Développer et mettre en œuvre des politiques et des procédures pour assurer un environnement de
                    travail sûr et répondre aux normes de sécurité les plus strictes.</p>
                <h4 id="list-item-2">Amélioration Continue des Méthodes</h4>
                <p>Utiliser les retours d'expérience et les analyses de performance pour améliorer les méthodes de
                    travail, les processus et l'efficacité globale.</p>
                <h4 id="list-item-1">Intégration de la Technologie dans la Prise de Décision</h4>
                <p>Appliquer des outils technologiques avancés pour analyser les données, améliorer les processus de
                    décision et optimiser la gestion des ressources.</p>
                <h4 id="list-item-4">Contrôle Qualité et Conformité</h4>
                <p>Assurer la qualité des produits ou services et leur conformité avec les normes internes et externes,
                    à travers des audits réguliers et des évaluations de conformité.</p>
                <h4 id="list-item-5">Engagement pour la Responsabilité Environnementale</h4>
                <p>Promouvoir des pratiques respectueuses de l'environnement, en réduisant les déchets, en améliorant
                    l'efficience énergétique et en soutenant la durabilité globale.</p>
                <h4 id="list-item-6">Optimisation de l'Efficiacité Opérationnelle</h4>
                <p>Identifier les goulots d'étranglement et les inefficacités dans les opérations pour les résoudre, en
                    visant une amélioration continue et une optimisation des coûts.</p>
            </div>
        </div>
    </div>
</div>


<!-- Affichage des elements -->
<h1 class="container">SMQE</h1>
<?php echo displayFrameworks($results)?>
<!-- fin Affichage des elements -->

<!-- systeme de pagination -->
<?php echo displayPagination($pages, $page, $_GET); ?>
<!--fin de systeme depagination  -->

<!-- footer -->
<?php echo view('templates/footer'); ?>