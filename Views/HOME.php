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


//sql pour récupérer tous les domaines
$sqlD = "SELECT * FROM domains";
$queryD = $pdo->query($sqlD);
$domaines = $queryD->fetchAll(PDO::FETCH_ASSOC);

// Préparation et exécution de la requête pour obtenir des données sur les domaines et leurs projets associés
$sqlDP = "SELECT D.domain_name, P.project_name, P.description FROM domains AS D
INNER JOIN projects AS P ON P.domain_id = D.domain_id";
$queryDP = $pdo->query($sqlDP);
$DomaineParProjet = $queryDP->fetchAll(PDO::FETCH_ASSOC); // Correction du nom de variable ici

//sql pour récupérer les FAQs par projet
$sqlPF = "SELECT P.project_name, P.description, F.question, F.answer FROM projects AS P
INNER JOIN faqs AS F ON F.project_id = P.project_id";
$queryPF = $pdo->query($sqlPF);
$FaqParProject = $queryPF->fetchAll(PDO::FETCH_ASSOC); // Correction du nom de variable ici

// Vérifie si les requêtes ont renvoyé des résultats non vides
if ($domaines && $DomaineParProjet && $FaqParProject) {

} else {
    echo "Erreur dans l'exécution de la requête.";
}

  }
  

} catch (PDOException $e) {
  // Gère l'erreur de connexion
  die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['domain_name'])) {
    $var = $_GET["domain_name"];
    $response = '<h3 class="container text-light">'.$var.'</h3><br>';
    foreach ($domaines as $domaine) {
        if($domaine["domain_name"]==$var){
            $response .= '<div class="container text-light">'.$domaine['description'].'</div>';
        }
    }

    foreach ($DomaineParProjet as $Dprojet) {
        if ($Dprojet['domain_name'] === $_GET['domain_name']) {
            $response .= '<button type="button" class="btn btn-light m-2 shadow" onclick="afficherDetailsProjet(\'' . htmlentities($Dprojet['project_name']) . '\')">' . 
            htmlentities($Dprojet['project_name']) . '</button>';
        }
    }
    echo $response;
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['project_name'])) {
    $projectName = $_GET['project_name'];
foreach ($DomaineParProjet as $DparP) {
    if ($DparP["project_name"] == $projectName) {
        echo '<p class="container text-light">' . htmlentities($DparP['description']) . '</p>';
    }
}
foreach ($FaqParProject as $FparP) {
    if($FparP["project_name"] == $projectName){
        echo '<button type="button" class="btn btn-light m-2 shadow" onclick="afficheReponse(\'' . htmlentities($FparP['question']) . '\')">' . htmlentities($FparP['question']) . '</button>';
    }
}
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['question'])) {
    $projectName = $_GET['question'];

foreach ($FaqParProject as $FparP) {
    if($FparP["question"] == $_GET['question']){
        echo '<p class="alert alert-warning m-2 shadow">' . htmlentities($FparP['answer']) . '</p>';
    }
}
    exit;
}



$PthImages =  "/assets/images/"
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" type="text/css" href="./style.css" /> -->
    <link rel="icon" href="/assets/images/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="assets/images/logoagetipa.ico" type="image/x-icon">
    <title>Boîte à outils IA 2.0</title>
    <style>
    :root {
        /* Définition de la variable pour la couleur du texte */
        --text-color: #000000;
        /* Noir par défaut, mais vous pouvez choisir n'importe quelle couleur */
    }

    .centered {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        height: 100%;
    }

    .department-box {
        position: relative;
        display: inline-block;
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    .department-box p {
        margin-top: 10px;
        font-weight: bold;
    }

    .department-box::before {
        content: attr(data-text);
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #f2f2f2;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: bold;
    }

    #logo {
        height: 10vh;

    }

    #menu ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: lightgreen;
    }

    #menu li {
        float: right;
    }

    #menu li a {
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .img {
        width: 100%;
        height: 50%;

    }

    header {
        position: fixed;
        /* Fixed position */
        top: 0;
        /* Align to the top */
        width: 100%;
        /* Full width */
        /*background-color: #fff; /* Change this to match your header's background */
        z-index: 1000;
        /* Ensures the header stays above other content */
        background: #fffffff21;
    }

    body {
        padding-top: 1px;
        overflow-x: hidden
        /* Replace [HeaderHeight] with the actual height of your header */
    }

    footer {
        padding: 20px;
        box-sizing: border-box;
    }

    .slider {
        height: 50vh;
        width: 100vh;
        border: 1px solid black;

    }

    .custom-opacity {
        opacity: 0.75;
        /* 70% d'opacité */
    }

    .black-and-white {
        filter: grayscale(100%);
    }

    .header-bg-white {
        background-color: white !important;
        transition: background-color 0.5s;
        /* Transition douce pour le changement de couleur */
    }

    .img-header {}


    #menu {
        position: absolute;
        bottom: 0;
        right: 0;
        /* Adjust as needed */
        z-index: 10;
        /* Ensures the menu is above the carousel images */
    }

    #menu1 {
        position: absolute;
        bottom: 5%;
        right: 60%;
        /* Adjust as needed */
        z-index: 10;
        /* Ensures the menu is above the carousel images */
    }

    .agepita_color {
        background-color: #009245;
        font-weight: bold;
    }

    .titlebackground {
        background-color: #009245;
        font-weight: bold;
        color: #FFF;
        transition: background-color 0.3s ease-in-out;
    }

    .titlebackground:hover {

        background-color: #0859313d;
        color: var(--text-color);
    }

    .bg-color-guide {
        background-color: #ebfafa;
    }

    .bg-color-prompt {
        background-color: #cad8e300;
    }

    .chatbot-container {
        position: fixed;
        bottom: 0;
        right: 0;
        width: 50%;
        /* ou la largeur souhaitée */
        display: none;
        /* pour commencer caché */
        z-index: 1052;
    }

    #chatbotButton {
        display: none;
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1051;
    }

    #chatbotButton2 {
        display: block;
        position: fixed;
        bottom: 7rem;
        right: 2rem;
        z-index: 1051;
    }

    .chatbot-position {
        position: fixed;
        z-index: 2;
        top: ;
        left: 0;
        z-index: 1050;
    }

    .agetipa_color2 {
        background-color: #6a0dad;
        /* Couleur violette */
        font-weight: bold;
    }

    .transition-gauche-droit {
        transition: transform 0.2s ease-in-out;
    }

    .transition-gauche-droit:hover {
        transform: scale(1.02);
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateX(-50px);
        transition: opacity 0.5s ease-out, transform 0.6s ease-out;
    }

    .visible {
        opacity: 1;
        transform: translateY(0);
    }

    .img-gpt-home {
        position: absolute;
        top: 40px;
        left: 40px;
        z-index: 2;
        width: 70%;
        height: 70%;
    }

    .cadre-img-gpt-home {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1;
        width: 70%;
        height: 70%;
        border: 1rem solid #009245;
    }

    html body .container .link-success::after {
        content: none !important;
    }

    .key-resource {
        font-weight: bold;
        color: #085930;
        /* Bootstrap primary color */
    }

    .btn-primary {
        background-color: #009245;
    }

    .bg-chatbot {
        background: #08593082;
    }

    .bg-chatbot:hover {
        background-color: #085930ad
    }

    .bg-chatbot2 {
        background: #6a0dada1;
    }

    .bg-chatbot2:hover {
        background-color: #6a0dadba
    }

    @media (max-width: 1000px) {
        #menu {
            position: static;
            /* Resets position to default */
            width: 100%;
            /* Takes full width */
            right: auto;
            /* Resets right position */
            bottom: auto;
            /* Resets bottom position */
        }

        #menu1 {
            display: none !important;
            /* Hide #menu1 on small screens */
        }
    }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light w-100">
            <div class="container-fluid">
                <a href="https://www.agetipa.mg/">
                    <img id="logo" src="assets/images/logo.png" class="" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="row w-100">
                        <div class="col-12 col-md-10 d-flex justify-content-center">
                            <h3
                                style="color: #009245; font-weight: bold; margin-left: 20px; text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;">
                                Agence d'exécution des travaux d'intérêt public et d'aménagement</h3>
                        </div>
                        <div class="col-12 col-md-2"> <?php if (session()->get('isLoggedIn')): ?>
                            <a class="btn agepita_color text-light" href="/auth/logout"
                                style="display: inline; cursor: pointer;">Déconnexion</a>
                            <?php else: ?>
                            <a class="nav-link btn agepita_color text-light" href="/login">Connexion</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="d-inline slider custom-opacity">
        <!-- Carousel structure -->
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="position: relative;">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="100">
                    <img src="assets/images/3.jpg" class="img black-and-white">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="assets/images/4.jpg" class="img black-and-white">
                </div>
                <div class="carousel-item">
                    <img src="assets/images/1.jpg" class="img black-and-white">
                </div>
            </div>

            <div id="menu1" class="titlebackground rounded-circle"
                style="height: 30rem; width : 30rem; display: flex; justify-content: center; align-items: center;">
                <div class="centered container">
                    <h2 id="init">Boîte à outils de l'AGETIPA</h2>
                    <p class="lead">🚀 Gagnez en productivité
                        grâce à l'automatisation intelligente</p>
                </div>
            </div>

            <div id="menu" class="w-100">
                <div class="row m-1 mb-5">
                    <div class="col"></div>
                    <div class="col-12 col-xl-7">
                        <div class="row">
                            <div class="col-12 col-md-6 col-xl p-2 btn agepita_color border border-light">
                                <a href="/prompts" class="text-light text-decoration-none">Prompts</a>
                            </div>
                            <div class="col-12 col-md-6 col-xl p-2 btn agepita_color border border-light">
                                <a href="/framework" class="text-light text-decoration-none">Framework</a>
                            </div>
                            <div class="col-12 col-md-6 col-xl p-2 btn agepita_color border border-light">
                                <a href="/gpts" class="text-light text-decoration-none">GPTs</a>
                            </div>
                            <div class="col-12 col-md-6 col-xl p-2 btn agepita_color border border-light">
                                <a href="/outilia" class="text-light text-decoration-none">Outil IA</a>
                            </div>
                            <div class="col-12 col-md-6 col-xl p-2 btn agepita_color border border-light">
                                <a href="/listefaqs" class="text-light text-decoration-none">Faqs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- fin carousel -->

    <!-- Guide d'utilisation -->
    <div>
        <div class="container">
            <h2 class="mb-4 text-center">Bienvenue dans la boîte à outils IA de l'AGETIPA !</h2>
            <p class="lead">Ce guide vous aidera à naviguer efficacement parmi les différentes ressources proposées et à
                tirer le meilleur parti de cette boîte à outils puissante.</p>


            <!-- GPTs -->
            <div class="row ">
                <div class="col-12 col-lg-6" style="position: relative; min-height: 40vh;">
                    <div class="cadre-img-gpt-home rounded"></div>
                    <a href="/gpts" class="link-success">
                        <img src="/assets/images/chatgpt2.jpg" class="rounded img-gpt-home transition-gauche-droit"
                            alt="">
                    </a>
                </div>
                <div class="col-12 col-lg-6 d-flex align-items-center">
                    <div class="container">
                        <div class="my-4 p-3 border rounded shadow-sm bg-light">
                            <h5 class="text-success mb-3"><i class="bi bi-tools"></i> <a href="/gpts"
                                    class="link-success stretched-link">GPTs</a></h5>
                            <p class="lead mb-2">Découvrez les GPTs (Grands Modèles de Langage Pré-entraînés) classés
                                par département cible pour une navigation facilitée. Ces GPTs, véritables couteaux
                                suisses du traitement de l'information, permettent d'accomplir une multitude de tâches.
                            </p>
                            <p class="text-muted">Les tâches incluent le résumé de texte, l'analyse d'images, la
                                rédaction spécialisée, l'analyse de tableaux, et des recherches spécifiques dans des
                                domaines variés comme l'informatique, le génie civil, les mathématiques et la
                                législation.</p>
                        </div>


                    </div>
                </div>
            </div>
            <!-- fin GPTs -->


            <!-- Outils IA -->
            <div class="row ">
                <div class="col-12 col-lg-6 d-flex align-items-center">
                    <div class="container">
                        <div class="my-4 p-3 border rounded shadow-sm bg-light">
                            <h5 class="text-success mb-3"><i class="bi bi-tools"></i> <a href="/outilia"
                                    class="link-success stretched-link">Outils IA</a></h5>
                            <p class="lead mb-2">Découvrez notre arsenal d'<strong>outils de chatbots</strong>,
                                méticuleusement sélectionnés pour booster l'efficacité de nos équipes. Chaque outil a
                                été testé et approuvé par nos développeurs pour sa fiabilité et sa pertinence dans le
                                cadre de nos projets.</p>
                            <p class="text-muted">Ces outils sont régulièrement mis à jour pour garantir une performance
                                optimale et soutenir nos consultants d'AGETIPA dans leurs défis quotidiens.</p>
                        </div>


                    </div>
                </div>

                <div class="col-12 col-lg-6" style="position: relative; min-height: 40vh;">
                    <div class="cadre-img-gpt-home rounded"></div>
                    <a href="/outilia" class="link-success">
                        <img src="/assets/images/intelligence-artificielle-et-conseil-1200x675.jpg"
                            class="rounded img-gpt-home transition-gauche-droit" alt="">
                    </a>

                </div>
            </div>

            <!-- Fin Outils -->

            <!-- Framework -->

            <div class="row ">
                <div class="col-12 col-lg-6" style="position: relative; min-height: 40vh;">
                    <div class="cadre-img-gpt-home rounded"></div>
                    <a href="/framework" class="link-success">
                        <img src="/assets/images/PAR-framwork-1024x585.jpg"
                            class="rounded img-gpt-home transition-gauche-droit shadow" alt="">
                    </a>

                </div>
                <div class="col-12 col-lg-6 d-flex align-items-center">
                    <div class="container">
                        <div class="my-4 p-3 border rounded shadow-sm bg-light">
                            <h5 class="text-success mb-3"><a href="/framework"
                                    class="link-success stretched-link">Frameworks de prompts</a></h5>
                            <p class="lead mb-2">Explorez notre collection de <strong>frameworks de prompts</strong>,
                                conçus pour vous aider à structurer vos interactions avec les modèles de langage de
                                manière plus efficace et intuitive.</p>
                            <p class="text-muted">Chaque framework est adapté pour différentes applications, assurant
                                une intégration fluide et des résultats optimisés pour vos projets.</p>
                            <h1 style="height: 16px; margin : 16px"></h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fin Framework -->


            <!-- Prompt -->

            <div class="row">
                <div class="col-12 col-lg-6 d-flex align-items-center">
                    <div class="container">
                        <div class="my-4 p-3 border rounded shadow-sm bg-light">
                            <h5 class="text-success mb-3"><i class="bi bi-chat-left-text"></i> <a href="/prompts"
                                    class="link-success stretched-link">Prompts</a></h5>
                            <p class="lead mb-2">Découvrez une variété de <strong>prompts</strong> (instructions ou
                                contextes), spécialement conçus pour faciliter des tâches variées, et soigneusement
                                organisés par cible, framework, outil IA, et résultats attendus.</p>
                            <p class="text-muted">Chaque prompt est optimisé pour vous offrir les meilleures chances de
                                succès dans vos projets spécifiques, en augmentant l'efficacité et la pertinence de vos
                                interactions IA.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6" style="position: relative; min-height: 40vh;">
                    <div class="cadre-img-gpt-home rounded"></div>
                    <a href="/prompts" class="link-success">
                        <img src="/assets/images/639c7b40ee483t.png"
                            class="rounded img-gpt-home transition-gauche-droit" alt="">
                    </a>

                </div>
            </div>

            <!-- Fin Prompt -->

            <p class="lead mb-1">Ce guide didactique vous permettra de naviguer aisément dans cette boîte à outils IA
                complète et de tirer parti de son potentiel pour répondre à vos besoins spécifiques. N'hésitez pas à
                l'explorer et à exploiter pleinement ces ressources pour optimiser votre productivité et la qualité de
                votre
                travail.</p>
        </div>
    </div>

    <!-- fin Guide d'utilisation -->

    <!--  -->
    <div class="bg-color-prompt">
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <h1 class="mb-3 text-center" id="init">Découvrez les prompts adaptés à votre profil</h1>
                    <p class="text-justify lead">La boîte à outils IA est un appui qui va apporter plus d'efficacité et
                        une
                        meilleure exploitation des données en déchargeant les collaborateurs des tâches répétitives. Les
                        prompts sont regroupés en fonction des utilisateurs suivant les liens ci-dessous.</p>
                </div>
            </div>
        </div>
    </div>

    <!--  -->

    <!--  -->
    <div class="container department-container mt-5">
        <a href="/administration" class="department-box" data-text="Contient des prompts pour">
            <img src="<?php echo $PthImages."administration.png"?>" alt="Administration">
            <p>Administration</p>
        </a>
        <a href="/development" class="department-box" data-text="Contient des prompts pour">
            <img src="<?php echo $PthImages."development.png"?>" alt="Development">
            <p>Development</p>
        </a>
        <a href="/direction" class="department-box" data-text="Contient des prompts pour">
            <img src="<?php echo $PthImages."board.png"?>" alt="Board">
            <p>Direction</p>
        </a>
        <a href="/marketing-digital" class="department-box" data-text="Contient des prompts pour">
            <img src="<?php echo $PthImages."marketing.png"?>" alt="Marketing">
            <p>Marketing Digital</p>
        </a>
        <a href="/sig" class="department-box" data-text="Contient des prompts pour">
            <img src="<?php echo $PthImages."gis.png"?>" alt="GIS">
            <p>SIG</p>
        </a>
        <a href="/smqe" class="department-box" data-text="Contient des prompts pour">
            <img src="<?php echo $PthImages."quality.png"?>" alt="Quality">
            <p>SMQE</p>
        </a>
        <a href="/technique" class="department-box" data-text="Contient des prompts pour">
            <img src="<?php echo $PthImages."technique.png"?>" alt="Technique">
            <p>Technique</p>
        </a>
    </div>
    <!--  -->

    <!--  -->
    <div class="container mt-5">
        <div class="jumbotron">
            <h2 class="display-4">👥 Que vous soyez un(e):</h2>
            <ul class="list-group">
                <li class="list-group-item">💻 Consultant(e)</li>
                <li class="list-group-item">📋 Chef de projet</li>
                <li class="list-group-item">🛠️ Membre d'une équipe technique</li>
                <li class="list-group-item">👔 Responsable de département</li>
                <li class="list-group-item">💼 Membre de la direction</li>
            </ul>
            <p class="mt-4">🎯 Vous trouverez des prompts parfaitement adaptés à vos tâches et défis quotidiens.</p>
        </div>

        <div class="bg-light p-4">
            <h4 class="mb-3">🚀 Profitez de cette opportunité pour:</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">✨ Optimiser vos processus</li>
                <li class="list-group-item">⏱️ Gagner en productivité</li>
                <li class="list-group-item">🌟 Et offrir un service de qualité supérieure à nos clients !</li>
            </ul>
        </div>

        <div class="alert alert-success mt-4" role="alert">
            <h4 class="alert-heading">🔑 La boîte à outils IA est la clé pour débloquer tout votre potentiel et celui de
                votre équipe.</h4>
            <p>Explorez dès maintenant les prompts qui correspondent à votre rôle !</p>
        </div>
    </div>
    <!--  -->



    <!-- CHATBOT -->

    <div id="chatbotContainer" class="chatbot-container " style="display:block; ">
        <div class="card shadow bg-chatbot" style="min-width : 100vh;">
            <div class="card-body">
                <h5 class="card-title text-light">Chatbot</h5>
                <div class="container py-1">
                    <div id="messageArea" class="border rounded p-1 mb-1"
                        style="overflow-y: scroll; max-height: 400px;">
                        <div class="row">
                            <!-- Les messages apparaitront ici -->
                            <div class="row">
                                <h5 class="mb-1 text-light"><i class="fa-solid fa-user"></i>IA assistant</h5>
                                <div class="alert alert-secondary shadow">
                                    <h4 class="d">Bienvenue à la Boîte à Outils AGETIPA</h4>
                                    <p class="lead">Cette plateforme est conçue pour vous fournir tous les outils
                                        nécessaires pour naviguer efficacement dans le monde de la technologie et de
                                        l'intelligence artificielle.</p>

                                    <h2>Explorer nos ressources :</h2>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <div class="" role="alert">
                                                <span class="key-resource">GPTs :</span> Si vous êtes intéressé par les
                                                dernières avancées en matière de modèles de langage, cliquez sur <a
                                                    href="<?=base_url("/gpts") ?>" class="btn btn-primary btn-sm">ce
                                                    lien</a> pour accéder à
                                                notre section dédiée aux technologies GPT.
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="key-resource">Outils IA :</span> Pour découvrir des outils
                                            basés sur l'intelligence artificielle qui peuvent transformer votre manière
                                            de travailler, cliquez sur <a href="<?=base_url("/outilia") ?>"
                                                class="btn btn-primary btn-sm">ce
                                                lien</a>.
                                        </li>
                                        <li class="list-group-item">
                                            <span class="key-resource">Frameworks de Prompts :</span> Accédez à nos
                                            frameworks pour optimiser l'utilisation de prompts en cliquant sur <a
                                                href="<?=base_url("/framework") ?>" class="btn btn-primary btn-sm">ce
                                                lien</a>.
                                        </li>
                                        <li class="list-group-item">
                                            <span class="key-resource">Prompts :</span> Explorez notre collection de
                                            prompts prêts à l'emploi en cliquant sur <a
                                                href="<?=base_url("/prompts") ?>" class="btn btn-primary btn-sm">ce
                                                lien</a>.
                                        </li>
                                    </ul>

                                    <h2>Nous sommes là pour vous aider :</h2>
                                    <p>Si vous avez une préoccupation ou une demande spécifique, n'hésitez pas à
                                        l'écrire dans la zone de texte prévue à cet effet. Nous vous répondrons dans les
                                        plus brefs délais.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="messageForm">
                        <div class="input-group">
                            <input type="text" class="form-control mx-2" placeholder="Écrivez un message..."
                                id="messageInput">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
                <button id="closeButton" class="btn btn-danger">Fermer</button>
            </div>
        </div>
    </div>

    <button id="chatbotButton" class="btn agetipa_color  text-light transition-gauche-droit">
        <div class="row">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-quote"
                viewBox="0 0 16 16">
                <path
                    d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105" />
                <path
                    d="M7.066 6.76A1.665 1.665 0 0 0 4 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z" />
            </svg>
        </div>
        Chat
    </button>
    <!-- Fin CHATBOT -->

    <!-- Deuxième CHATBOT (Nouveau) -->
    <div id="chatbotContainer2" class="chatbot-container" style="display:none;">
        <div class="card shadow bg-chatbot2">
            <div class="card-body">
                <h5 class="card-title text-light">AGETIPA</h5>
                <div class="container py-1">
                    <div id="messageArea2" class="border rounded p-1 mb-1"
                        style="overflow-y: scroll; max-height: 400px; background: #000000a3">
                        <div class="container">
                            <div class="row">
                                <div class="">
                                    <h4 class="text-light">Bienvenue sur le Chatbot AGETIPA !</h4>
                                    <p class="text-light">Je suis ici pour vous aider à explorer les projets et les
                                        services
                                        que propose l'AGETIPA. Que vous soyez membre de notre organisation, un de nos
                                        partenaires, ou simplement intéressé par ce que nous faisons, je suis là pour
                                        vous fournir des informations précises et répondre à vos interrogations.</p>
                                    <hr class="my-1">
                                    <h5 class="text-light">Comment puis-je vous aider aujourd'hui ?</h5>
                                    <ul class="list-unstyled">
                                        <li class="lead">
                                            <p class="alert alert-light shadow text-dark">Pour en savoir plus sur un
                                                projet spécifique,
                                                cliquez sur le domaine qui vous intéresse.</p>
                                        </li>
                                        <li class="lead">
                                            <p class="alert alert-light shadow text-dark">Pour des informations sur un
                                                domaine
                                                particulier de l'AGETIPA, cliquez sur le domaine que vous voulez
                                                savoir.</p>
                                        </li>
                                        <li class="lead">
                                            <p class="alert alert-light shadow text-dark">Si
                                                vous avez des questions générales ou besoin d’assistance, cliquez sur
                                                les questions fréquemment posées.</p>
                                        </li>
                                    </ul>
                                </div>
                                <!-- ici -->
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="container alert alert-light m-2 p-1 shadow" style="background: #000000a3">
                            <h4 class="text-light">Domaines : </h4>
                            <?php if($domaines):?>
                            <?php foreach($domaines as $domaine): ?>
                            <button type="button" class="btn btn-light text-secondary my-1 shadow"
                                onclick="afficherProjets('<?php echo htmlentities($domaine['domain_name']); ?>')">
                                <?php echo htmlentities($domaine["domain_name"]); ?>
                            </button>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <form id="messageForm2">
                        <div class="input-group">
                            <input type="text" class="form-control mx-2" placeholder="Écrivez un message..."
                                id="messageInput2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
                <button id="closeButton2" class="btn btn-danger">Fermer</button>
            </div>
        </div>
    </div>

    <button id="chatbotButton2" class="btn agetipa_color2 text-light transition-gauche-droit">
        <div class="row">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-quote"
                viewBox="0 0 16 16">
                <path
                    d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105" />
                <path
                    d="M7.066 6.76A1.665 1.665 0 0 0 4 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 7.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 0 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z" />
            </svg>
        </div>
        FAQ
    </button>
    <!-- Fin CHATBOT (Nouveau) -->



    <script>
    //ici les fonctions pour les chatbot 2
    function afficherProjets(domainName) {
        var xhr = new XMLHttpRequest();
        // Préparer l'URL avec les paramètres pour la requête GET
        var url = "?domain_name=" + encodeURIComponent(domainName);
        xhr.open("GET", url, true); // Modifier ici pour utiliser GET

        // Gestion des changements d'état de la requête
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Crée un élément pour ajouter le contenu
                var newContent = document.createElement('div');
                newContent.innerHTML = xhr.responseText;
                // Append le nouvel élément au container
                document.querySelector("#messageArea2 .container").appendChild(newContent);
                // Défilement vers le nouvel élément
                newContent.scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
            }
        };

        // Envoi de la requête sans corps de message
        xhr.send(); // Aucune donnée n'est envoyée avec GET dans la méthode send()
    }

    function afficherDetailsProjet(projectName) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "?project_name=" + encodeURIComponent(projectName), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Crée un élément pour ajouter le contenu
                var newContent = document.createElement('div');
                newContent.innerHTML = xhr.responseText;
                // Append le nouvel élément au container
                document.querySelector("#messageArea2 .container").appendChild(newContent);
                // Défilement vers le nouvel élément
                newContent.scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
            }
        };
        xhr.send();
    }

    function afficheReponse(projectName) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "?question=" + encodeURIComponent(projectName), true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Crée un élément pour ajouter le contenu
                var newContent = document.createElement('div');
                newContent.innerHTML = xhr.responseText;
                // Append le nouvel élément au container
                document.querySelector("#messageArea2 .container").appendChild(newContent);
                // Défilement vers le nouvel élément
                newContent.scrollIntoView({
                    behavior: 'smooth',
                    block: 'end'
                });
            }
        };
        xhr.send();
    }

    //fin fonction chatbot 2

    document.getElementById("messageForm").addEventListener("submit", (e) => {
        e.preventDefault();

        const input = document.getElementById("messageInput");
        if (!input.value.trim()) return;

        addMessage("Moi", input.value);
        // Préparation des données pour l'API ChatGPT
        const data = "sk-proj-Ensr9NgXY0jTOZXMLOgKT3BlbkFJHhAxy89Txs5tiTibPHsm";

        fetch('https://api.openai.com/v1/chat/completions', {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${data}` // Assurez-vous de remplacer ceci par votre clé d'API
                },
                body: JSON.stringify({
                    model: "gpt-3.5-turbo",
                    messages: [{
                        role: "user",
                        content: `${input.value}`
                    }]
                })
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log(data)
                // Vérification si data.choices existe et contient des éléments
                if (data.choices && data.choices.length > 0) {
                    const reply = data.choices[0].message.content; // Extrait la réponse
                    addMessage("IA assistant", reply); // Utilise la réponse de ChatGPT
                } else {
                    console.error("Aucune réponse reçue de ChatGPT");
                }
            })
            .catch(error => console.error('Erreur:', error));
        input.value = ""; // Réinitialise le champ de texte après l'envoi
    });

    function addMessage(sender, message) {
        const messageArea = document.getElementById("messageArea");
        const messageDiv = document.createElement("div");
        messageDiv.classList.add("mb-2");
        if (sender == "Moi") {
            messageDiv.innerHTML = `
                            <div class="row">
                                <h5 class="mb-1 text-light"><i class="fa-solid fa-robot"></i> ${sender}</h5>
                                <div class="alert alert-success shadow"><span >${message}</span></div>
                            </div>`;
        } else {
            messageDiv.innerHTML = `<div class="row">
                                <h5 class="mb-1 text-light"><i class="fa-solid fa-user"></i> ${sender}</h5>
                                <div class="alert alert-secondary shadow"><span >${message}</span></div>
                            </div>`;
        }
        messageArea.appendChild(messageDiv);
        messageArea.scrollTop = messageArea.scrollHeight; // Fait défiler vers le bas pour la dernière réponse
    }


    // Cachez ou affichez le chatbot et ajustez la visibilité du bouton du chatbot
    document.addEventListener("DOMContentLoaded", function() {

        document.getElementById('chatbotButton').addEventListener('click', function() {
            var chatbotContainer = document.getElementById('chatbotContainer');
            chatbotContainer.style.display = 'block';
            this.style.display = 'none'; // Cachez le bouton du chatbot
        });

        // Ajoutez un écouteur pour le bouton de fermeture dans le conteneur du chatbot
        document.getElementById('closeButton').addEventListener('click', function() {
            var chatbotContainer = document.getElementById('chatbotContainer');
            chatbotContainer.style.display = 'none';
            document.getElementById('chatbotButton').style.display =
                'block'; // Réaffichez le bouton du chatbot
        });

    });

    document.addEventListener("DOMContentLoaded", function() {
        // Gestionnaire pour le bouton du premier chatbot
        // Ajout des gestionnaires pour le deuxième chatbot
        document.getElementById('chatbotButton2').addEventListener('click', function() {
            var chatbotContainer2 = document.getElementById('chatbotContainer2');
            chatbotContainer2.style.display = 'block';
            this.style.display = 'none'; // Cache le bouton du deuxième chatbot
        });

        document.getElementById('closeButton2').addEventListener('click', function() {
            var chatbotContainer2 = document.getElementById('chatbotContainer2');
            chatbotContainer2.style.display = 'none';
            document.getElementById('chatbotButton2').style.display =
                'block'; // Réaffiche le bouton du deuxième chatbot
        });
    });


    //transition et translation des Menu
    document.addEventListener("DOMContentLoaded", function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                } else {
                    entry.target.classList.remove('visible');
                }
            });
        }, {
            rootMargin: '0px',
            threshold: 0.1
        });

        document.querySelectorAll('.department-box').forEach(box => {
            observer.observe(box);
            box.classList.add('animate-on-scroll');
        });
    });
    </script>
    <!-- footer -->
    <?php echo view('templates/footer'); ?>