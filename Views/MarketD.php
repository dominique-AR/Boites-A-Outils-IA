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
      $sqlCount = "SELECT COUNT(id) as total FROM promptIA WHERE cible = 'direction'";
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
      $sql = "SELECT * FROM promptIA WHERE cible = 'direction' ORDER BY id OFFSET {$vers} LIMIT 5";
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
    <h2 class="mb-4">Objectifs Clés pour le Marketing Digital 🚀</h2>
</div>
<div class="container my-5">
    <div class="row">
        <div class="col-4">
            <!-- Liste de navigation pour le Scrollspy -->
            <div id="list-example" class="list-group">
                <a class="list-group-item list-group-item-action" href="#list-item-1">Maximiser la Visibilité en
                    Ligne</a>
                <a class="list-group-item list-group-item-action" href="#list-item-2">Optimiser le SEO et le Contenu</a>
                <a class="list-group-item list-group-item-action" href="#list-item-3">Engager via les Réseaux
                    Sociaux</a>
                <a class="list-group-item list-group-item-action" href="#list-item-4">Utiliser l'Analytique pour le
                    ROI</a>
                <a class="list-group-item list-group-item-action" href="#list-item-5">Innover avec le Marketing
                    d'Influence</a>
                <a class="list-group-item list-group-item-action" href="#list-item-6">Améliorer l'Expérience
                    Utilisateur</a>
            </div>
        </div>
        <div class="col-8">
            <!-- Contenu à défiler avec Scrollspy -->
            <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0" class="scrollspy-example"
                tabindex="0">
                <h4 id="list-item-1">Maximiser la Visibilité en Ligne</h4>
                <p>Stratégies pour augmenter la présence numérique à travers les moteurs de recherche et les plateformes
                    sociales, essentielles pour atteindre une audience plus large.</p>
                <h4 id="list-item-2">Optimiser le SEO et le Contenu</h4>
                <p>Techniques avancées de SEO et création de contenu de qualité pour améliorer le classement dans les
                    moteurs de recherche et engager efficacement l'audience.</p>
                <h4 id="list-item-3">Engager via les Réseaux Sociaux</h4>
                <p>Utiliser les plateformes sociales pour créer une communauté fidèle autour de la marque, en favorisant
                    l'interaction et en diffusant du contenu viral.</p>
                <h4 id="list-item-4">Utiliser l'Analytique pour le ROI</h4>
                <p>Emploi d'outils d'analytique pour mesurer, analyser et améliorer le retour sur investissement des
                    campagnes de marketing digital.</p>
                <h4 id="list-item-5">Innover avec le Marketing d'Influence</h4>
                <p>Collaboration avec des influenceurs pour étendre la portée de la marque et gagner en crédibilité
                    auprès de nouveaux segments de marché.</p>
                <h4 id="list-item-6">Améliorer l'Expérience Utilisateur</h4>
                <p>Optimiser les parcours utilisateurs sur les plateformes numériques pour augmenter la conversion et
                    fidéliser la clientèle grâce à une expérience utilisateur sans faille.</p>
            </div>
        </div>
    </div>
</div>


<!-- Affichage des elements -->
<h1 class="container">Marketing Digital</h1>
<?php echo displayFrameworks($results)?>
<!-- fin Affichage des elements -->

<!-- systeme de pagination -->
<?php echo displayPagination($pages, $page, $_GET); ?>
<!--fin de systeme depagination  -->

<!-- footer -->
<?php echo view('templates/footer'); ?>