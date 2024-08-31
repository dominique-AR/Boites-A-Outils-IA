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

if ($pdo) {
    //echo "Connecté à la base de données $dbname avec succès!";

    // Initialisation de la requête pour compter le nombre total d'éléments
    $sqlCount = "SELECT COUNT(id) as total FROM promptia";
    $parameters = []; // Tableau pour stocker les paramètres de la requête

    // Vérifie si un paramètre de recherche a été fourni
    if (isset($_GET["search"])) {
        $searchTerm = '%' . $_GET["search"] . '%';  // Convertit la recherche en minuscule
        // Ajoute la condition de filtrage dans la requête
        $sqlCount .= " WHERE activites LIKE :search OR resultats LIKE :search OR taches LIKE :search";
        $parameters['search'] = $searchTerm;
    }
    // Préparation et exécution de la requête de comptage
    $stmtCount = $pdo->prepare($sqlCount);
    $stmtCount->execute($parameters);
    $resultscount = $stmtCount->fetch();
    
    
    // Calcul du nombre de pages
    $pages = (int) ceil($resultscount['total']/2);
    $page = empty($_GET["page"]) ? 1 : (int) $_GET["page"];

    // Point de départ pour la pagination
    $offset = ($page - 1)*2;

    // Construction de la requête de sélection avec pagination
    $sql = "SELECT * FROM promptia";
    if (!empty($parameters)) {
        $sql .= " WHERE activites LIKE :search";
    }
    $sql .= " ORDER BY id LIMIT 2 OFFSET :offset";
    $parameters['offset'] = $offset; // Ajout du paramètre d'offset

    // Préparation et exécution de la requête de sélection
    $stmt = $pdo->prepare($sql);
    $stmt->execute($parameters);

    if ($stmt) {
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
<style>
        .btn-successs {
            background-color: #28a745; /* Couleur verte par défaut de Bootstrap pour success */
            border-color: #28a745;
            color: white;
        }
        .btn-successs:hover {
            background-color: #ff0000; /* Rouge */
            border-color: #ff0000;
            color: white;
        }
        .btn-successs:hover .bi-youtube {
            fill: #ffffff; /* Blanc pour le logo YouTube */
        }
    </style>
<!-- fin header -->

<!-- Formulaire de Recherche de Prompt -->
<div class="container mt-5">
    <div class="my-2">
        <h4>Documentation sur les prompts</h4>
        <a href="https://docs.anthropic.com/fr/prompt-library/library" target="_blank" class="btn btn-success my-2">Prompt-library</a>
        <a href="https://www.youtube.com/@LudovicSalenne" target="_blank" class="btn btn-successs my-2">Ludovic Salenne <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
  <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
</svg></a>
    </div>
    <h3>Recherche de Prompt</h3>
    <form action="" method="get" class="input-group mb-3">
        <input type="text" class="form-control" id="recherche" name="search" placeholder="Entrez votre recherche ici..."
            required>
        <button type="submit" class="btn btn-outline-secondary">Rechercher</button>
    </form>
</div>
<!-- fin Formulaire de Recherche de Prompt -->

<div class="container">
    <a href="<?=site_url("promptia/create")?>" class="btn btn-success my-2">Ajout promptIA</a>
</div>

<!-- Affichage des elements -->
<?php echo displayFrameworks($results)  ?>
<!-- fin Affichage des elements -->


<!-- systeme de pagination -->
<?php echo displayPagination($pages, $page, $_GET); ?>
<!--fin de systeme depagination  -->

<!-- footer -->
<?php echo view('templates/footer'); ?>