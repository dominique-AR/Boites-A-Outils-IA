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

        //sql pour avoir le nombre des elements        
      $sqlCount = "SELECT COUNT(id) as total FROM plugins";
      $stmtCount = $pdo->query($sqlCount);
      $resultscount = $stmtCount->fetch();
      //Nombre de page
      $pages = (int)ceil($resultscount['total']/5);
      //var_dump($pages);
      $page = empty($_GET["page"]) ? 1 : (int)$_GET["page"];
      //var_dump($page);

        // Prépare une déclaration pour l'exécution
        //Point de depart
      $vers = empty($_GET['page'])||$_GET['page']==1 ? 0 : ($_GET['page']-1)*5;
      $sql = "SELECT plu.nom \"plugin\" , plu.url, plu.image, plu.description  FROM plugins as plu ORDER BY id OFFSET {$vers} LIMIT 5";

        if (isset($_GET['req'])) {
            $sql = "SELECT ci.nom as \"cible\", plu.nom as \"plugin\", plu.url, plu.image, plu.description FROM cible_category as ci INNER JOIN cible_cat_plu as ca ON ca.cible_id = ci.id INNER JOIN plugins as plu ON plu.id = ca.plugin_id";
            // Append the WHERE clause with a placeholder for secure parameter binding
            $sql .= " WHERE ci.nom = :req";

            // Prepare the SQL statement with the PDO object
            $stmt = $pdo->prepare($sql);

            // Bind the actual value from $_GET["req"] to the placeholder ':req'
            $stmt->bindValue(':req', $_GET["req"]);
        } else {
            // Prepare the SQL statement without the WHERE clause if "req" is not provided
            $stmt = $pdo->prepare($sql);
        }

        // Execute the prepared statement
        $stmt->execute();
        $sqlcib = "SELECT * FROM cible_category";
        $cibles = $pdo->query($sqlcib);

        // Vérifie si la requête a réussi
        if ($stmt) {
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

<div class="container w-100">
    <div class="row mt-5">
        <div class="col"><img src="assets/images/chatgpt.JPG" class="rounded chatgpts-img  mx-1" alt=""></div>
        <div class="col-10">

            <h3 class="">Assistants conversationnels basés sur l'IA</h3>
            <div class="row">
                <div class="col-4">
                    <!-- Liste de navigation pour le Scrollspy -->
                    <div id="list-example" class="list-group">
                        <a class="list-group-item list-group-item-action" href="#item-1">Génération de textes</a>
                        <a class="list-group-item list-group-item-action" href="#item-2">Analyse de documents</a>
                        <a class="list-group-item list-group-item-action" href="#item-3">Rédaction technique</a>
                        <a class="list-group-item list-group-item-action" href="#item-4">Adaptation du style</a>
                        <a class="list-group-item list-group-item-action" href="#item-5">Automatisation de tâches</a>
                        <a class="list-group-item list-group-item-action" href="#item-6">Gain de productivité</a>
                    </div>
                </div>
                <div class="col-8">
                    <!-- Contenu à défiler avec Scrollspy -->
                    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0"
                        class="scrollspy-example" tabindex="0">
                        <h4 id="item-1">Génération de textes de qualité sur une large variété de sujets</h4>
                        <p>Les GPT sont capables de générer du contenu écrit de manière fluide et pertinente, couvrant
                            un large éventail de sujets et de styles d'écriture.</p>
                        <h4 id="item-2">Analyse et résumé de documents complexes</h4>
                        <p>Ces systèmes d'IA peuvent analyser et résumer des documents longs et complexes, en extrayant
                            les informations clés de manière concise et structurée.</p>
                        <h4 id="item-3">Rédaction technique et support à la programmation</h4>
                        <p>Les GPT sont particulièrement utiles pour la rédaction technique, la documentation et même la
                            génération de code informatique grâce à leur compréhension approfondie du langage naturel.
                        </p>
                        <h4 id="item-4">Compréhension fine du contexte et adaptation du style d'écriture</h4>
                        <p>Ces modèles sont capables de saisir le contexte et d'adapter leur style d'écriture en
                            conséquence, que ce soit pour un ton formel, créatif ou autre.</p>
                        <h4 id="item-5">Automatisation de diverses tâches rédactionnelles</h4>
                        <p>Les GPT permettent d'automatiser un large éventail de tâches rédactionnelles, allant de la
                            création de contenu à la correction de texte, en passant par la traduction.</p>
                        <h4 id="item-6">Gain de productivité significatif</h4>
                        <p>En utilisant ces assistants conversationnels basés sur l'IA, vous pouvez bénéficier d'un gain
                            de productivité considérable dans vos activités liées à la rédaction et au traitement de
                            texte.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-5" style="height:5px; background-color:rgba(22,157,124,255); width: 100%"></div>
    </div>


    <!--  Boutons filtres -->
    <div class="d-flex justify-content-center mb-5" role="group" aria-label="Basic example">
        <div class="btn-group">
            <?php foreach ($cibles as $cible): ?>
            <a href="/gpts?req=<?php echo $cible['nom']; ?>" class="m-2">
                <button type="button" class="btn agetipa_color btn-lg text-light"><?php echo $cible['nom'] ?></button>
            </a>
            <?php endforeach?>
            <a href="/gpts" class="m-2">
                <button type="button" class="btn agetipa_color btn-lg text-light">All</button>
            </a>
        </div>
    </div>
    <!-- fin boutons filtres -->



    <!--  Affichage d'element chatGTPs -->
    <?php foreach ($results as $result): ?>
    <div class="card mb-3 shadow">
        <div class="row no-gutters my-5">
            <div class="col-md-4">
                <img src="assets/images/<?php echo $result["image"]; ?>" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $result['plugin']; ?></h5>
                    <div class="card-text">
                        <?php echo $result['description']; ?>
                    </div>
                    <a href="<?php echo $result["url"]; ?>" class="btn btn-primary" target="_blank">lien...</a>
                </div>
            </div>

        </div>

    </div>
    <?php endforeach;?>

    <!-- systeme de pagination -->
    <?php echo displayPagination($pages, $page, $_GET); ?>
    <!--fin de systeme depagination  -->

    <!-- footer -->
    <?php echo view('templates/footer'); ?>