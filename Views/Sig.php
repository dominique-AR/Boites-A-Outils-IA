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
      $sqlCount = "SELECT COUNT(id) as total FROM promptIA WHERE cible = 'sig'";
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
      $sql = "SELECT * FROM promptIA WHERE cible = 'sig' ORDER BY id OFFSET {$vers} LIMIT 5";
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
    <h2 class="mb-4">Objectifs Clés pour l'Exploitation des SIG 🚀</h2>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-4">
            <!-- Liste de navigation pour le Scrollspy -->
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action" href="#list-item-1">Cartographie et Visualisation</a>
                <a class="list-group-item list-group-item-action" href="#list-item-2">Analyse Spatiale Avancée</a>
                <a class="list-group-item list-group-item-action" href="#list-item-3">Gestion des Données
                    Géospatiales</a>
                <a class="list-group-item list-group-item-action" href="#list-item-4">Intégration des SIG dans la Prise
                    de Décision</a>
                <a class="list-group-item list-group-item-action" href="#list-item-5">Innovation en Télédétection</a>
                <a class="list-group-item list-group-item-action" href="#list-item-6">Développement Durable et SIG</a>
            </div>
        </div>
        <div class="col-8">
            <!-- Contenu à défiler avec Scrollspy -->
            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example"
                tabindex="0">
                <h4 id="list-item-1">Cartographie et Visualisation</h4>
                <p>Exploiter les capacités des SIG pour créer des cartes interactives et des visualisations qui
                    facilitent la compréhension des données complexes et des tendances géospatiales.</p>
                <h4 id="list-item-2">Analyse Spatiale Avancée</h4>
                <p>Utiliser les SIG pour effectuer des analyses spatiales complexes, permettant de résoudre des
                    problèmes environnementaux, sociaux et économiques en identifiant des modèles et des corrélations
                    dans les données géospatiales.</p>
                <h4 id="list-item-3">Gestion des Données Géospatiales</h4>
                <p>Améliorer la gestion et l'intégrité des données géospatiales, en assurant leur précision, leur mise à
                    jour et leur accessibilité pour les analyses et les prises de décision.</p>
                <h4 id="list-item-4">Intégration des SIG dans la Prise de Décision</h4>
                <p>Incorporer les insights et les analyses fournies par les SIG dans les processus décisionnels des
                    organisations et des gouvernements pour une planification et une gestion plus efficaces.</p>
                <h4 id="list-item-5">Innovation en Télédétection</h4>
                <p>Exploiter les nouvelles technologies et les données de télédétection pour améliorer la surveillance
                    environnementale, l'agriculture de précision et la gestion des catastrophes.</p>
                <h4 id="list-item-6">Développement Durable et SIG</h4>
                <p>Utiliser les SIG pour soutenir les objectifs de développement durable, en contribuant à une meilleure
                    gestion des ressources naturelles, à la conservation de l'environnement et à la planification
                    urbaine.</p>
            </div>
        </div>
    </div>
</div>


<!-- Affichage des elements -->
<h1 class="container">SIG</h1>
<?php echo displayFrameworks($results)?>
<!-- fin Affichage des elements -->

<!-- systeme de pagination -->
<?php echo displayPagination($pages, $page, $_GET); ?>
<!--fin de systeme depagination  -->

<!-- footer -->
<?php echo view('templates/footer'); ?>