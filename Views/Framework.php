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

        // Prépare une déclaration pour l'exécution
        $sql = 'SELECT * FROM framework';
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
    <?php if(!empty($results)): ?>
    <?php foreach($results as $row): ?>
    <div class="row alert alert-light shadow transition-gauche-droit">
        <h4 class="w-100 "><?php echo htmlspecialchars($row['framework']); ?></h4>
        <div class="w-100"><?php echo $row['elements']; ?></div>
        <div class="w-100"> <H5 class="h5-souligne">Exemple: </H5></div>
        <div class="w-100 alert alert-success my-3"><?php echo htmlspecialchars($row['exemple']); ?></div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- footer -->
<?php echo view('templates/footer'); ?>