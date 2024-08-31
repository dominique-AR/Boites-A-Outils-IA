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
      $sqlCount = "SELECT COUNT(id) as total FROM listia";
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
      $sql = "SELECT * FROM listia ORDER BY id"; //OFFSET {$vers} LIMIT 5
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
<div class="row">
    <div class="col-12 col-md-2">
        <ul id="asideMenu" class="nav flex-column">
        </ul>
    </div>
    <div class="col">
        <!--  Affichage d'element chatGTPs -->
        <div class="container content my-2">
            <h1 id="content1">Recherche avancée - idéation - analyse de documents</h1>
            <div class="row">
                <?php foreach ($results as $result): ?>
                <?php if(trim($result["classement"]) == "recherche"): ?>
                <div class="col-12 col-xl-6">
                    <div class="shadow card my-1">
                        <div class="row no-gutters">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6"><img
                                            src="assets/images/<?php echo $result["image"]; ?>" class="card-img"
                                            alt="..."></div>
                                    <div class="col-12 col-md-6">
                                        <h5 class="card-title"><?php echo $result['nom']; ?></h5>
                                    </div>
                                </div>
                                <div class="card-text">
                                    <?php echo $result['description']; ?>
                                </div>
                                <a href="<?php echo $result["url"]; ?>" class="btn btn-primary my-1"
                                    target="_blank">lien...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>


            <h1 id="content2">Translation</h1>
            <div class="row">
                <?php foreach ($results as $result): ?>
                <?php if( trim($result["classement"]) == "translation"): ?>
                <div class="col-12 col-xl-6">
                    <div class="shadow card mb-3 my-1">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="assets/images/<?php echo $result["image"]; ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['nom']; ?></h5>
                                    <div class="card-text">
                                        <?php echo $result['description']; ?>
                                    </div>
                                    <a href="<?php echo $result["url"]; ?>" class="btn btn-primary"
                                        target="_blank">lien...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>


            <h1 id="content3">Conversion de la parole en texte</h1>
            <div class="row">
                <?php foreach ($results as $result): ?>
                <?php if(trim($result["classement"]) == "speech to text"): ?>
                <div class="col-12 col-xl-6">
                    <div class="shadow card mb-2 my-1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <img src="assets/images/<?php echo $result["image"]; ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['nom']; ?></h5>
                                    <div class="card-text">
                                        <?php echo $result['description']; ?>
                                    </div>
                                    <a href="<?php echo $result["url"]; ?>" class="btn btn-primary"
                                        target="_blank">lien...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>

            <h1 id="content4">Discussion </h1>
            <div class="row">
                <?php foreach ($results as $result): ?>
                <?php if(trim($result["classement"]) == "discussion"): ?>
                <div class="col-12 col-xl-6">
                    <div class="shadow card mb-2 my-1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <img src="assets/images/<?php echo $result["image"]; ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['nom']; ?></h5>
                                    <div class="card-text">
                                        <?php echo $result['description']; ?>
                                    </div>
                                    <a href="<?php echo $result["url"]; ?>" class="btn btn-primary"
                                        target="_blank">lien...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>

            <h1 id="content5">Correction de texte</h1>
            <div class="row">
                <?php foreach ($results as $result): ?>
                <?php if(trim($result["classement"]) == "correction de texte"): ?>
                <div class="col-12 col-xl-6">
                    <div class="shadow card mb-2 my-1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <img src="assets/images/<?php echo $result["image"]; ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['nom']; ?></h5>
                                    <div class="card-text">
                                        <?php echo $result['description']; ?>
                                    </div>
                                    <a href="<?php echo $result["url"]; ?>" class="btn btn-primary"
                                        target="_blank">lien...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>


            <h1 id="content6">Audiovisuel</h1>
            <div class="row">
                <?php foreach ($results as $result): ?>
                <?php if(trim($result["classement"]) == "audiovisuel"): ?>
                <div class="col-12 col-xl-6">
                    <div class="shadow card mb-2 my-1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <img src="assets/images/<?php echo $result["image"]; ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['nom']; ?></h5>
                                    <div class="card-text">
                                        <?php echo $result['description']; ?>
                                    </div>
                                    <a href="<?php echo $result["url"]; ?>" class="btn btn-primary"
                                        target="_blank">lien...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>

            <h1 id="content7">Data Science</h1>
            <div class="row">
                <?php foreach ($results as $result): ?>
                <?php if(trim($result["classement"]) == "data science"): ?>
                <div class="col-12 col-xl-6">
                    <div class="shadow card mb-2 my-1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <img src="assets/images/<?php echo $result["image"]; ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['nom']; ?></h5>
                                    <div class="card-text">
                                        <?php echo $result['description']; ?>
                                    </div>
                                    <a href="<?php echo $result["url"]; ?>" class="btn btn-primary"
                                        target="_blank">lien...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>

            <h1 id="content8">Productivité</h1>
            <div class="row">
                <?php foreach ($results as $result): ?>
                <?php if(trim($result["classement"]) == "productivité"): ?>
                <div class="col-12 col-xl-6">
                    <div class="shadow card mb-2 my-1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <img src="assets/images/<?php echo $result["image"]; ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['nom']; ?></h5>
                                    <div class="card-text">
                                        <?php echo $result['description']; ?>
                                    </div>
                                    <a href="<?php echo $result["url"]; ?>" class="btn btn-primary"
                                        target="_blank">lien...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>

            <h1 id="content9">Automatisation</h1>
            <div class="row">
                <?php foreach ($results as $result): ?>
                <?php if(trim($result["classement"]) == "automatisation"): ?>
                <div class="col-12 col-xl-6">
                    <div class="shadow card mb-2 my-1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-4">
                                <img src="assets/images/<?php echo $result["image"]; ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result['nom']; ?></h5>
                                    <div class="card-text">
                                        <?php echo $result['description']; ?>
                                    </div>
                                    <a href="<?php echo $result["url"]; ?>" class="btn btn-primary"
                                        target="_blank">lien...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>




<!-- footer -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const menu = document.getElementById('asideMenu');
    document.querySelectorAll('.content h1').forEach(h1 => {
        const li = document.createElement('li');
        li.className = 'nav-item '; // Classe Bootstrap pour les éléments de navigation
        const a = document.createElement('a');
        a.className = 'nav-link text-secondary'; // Classe Bootstrap pour les liens dans nav
        a.textContent = h1.textContent;
        a.href = `#${h1.id}`;

        a.addEventListener('click', function(event) {
            event.preventDefault();
            const target = document.getElementById(h1.id);
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            document.querySelectorAll('#asideMenu .nav-link').forEach(link => {
                link.classList.remove('active'); // Remove active from all links
            });
            a.classList.add('active'); // Add active to the clicked link
        });

        li.appendChild(a);
        menu.appendChild(li);
    });
});


document.querySelectorAll('#asideMenu li').forEach(item => {
    item.addEventListener('click', function() {
        const contentId = this.getAttribute(
            'data-target'); // Get the target content ID from the data attribute
        const targetContent = document.getElementById(contentId);

        // Scroll to the <h1> element within the shown content
        targetContent.querySelector('h1').scrollIntoView({
            behavior: 'smooth', // Smooth scroll
            block: 'start' // Scroll to align with the top of the view
        });
    });
});
</script>
<?php echo view('templates/footer'); ?>