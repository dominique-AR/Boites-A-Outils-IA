<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" type="text/css" href="/style.css" /> -->
    <link rel="icon" href="Assets/logo.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <title>AI for Work</title>
    <style>
    .scrollspy-example {
        position: relative;
        height: 400px;
        /* Hauteur ajustée pour permettre le défilement */
        overflow-y: scroll;
    }

    #logo {
        height: 5rem;
    }

    header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        z-index: 2;
    }

    .sidebar {
        width: 200px;
        background-color: #f1f1f1;
        padding: 20px;
        height: calc(100vh - 320px);
        /* Adjusted height to position the sidebar below the logo */
        position: fixed;
        right: 20px;
        /* Moved the sidebar to the right */
        top: 320px;
        /* Positioned the sidebar below the logo */
        z-index: 1;
    }

    .sidebar a {
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
    }

    .sidebar a:hover {
        background-color: #ddd;
    }

    .main-content {
        margin-right: 240px;
        /* Adjusted the margin-right to accommodate the sidebar */
        padding: 20px;
    }

    .cms-container {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;
    }

    .cms-header {
        display: flex;
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .cms-cell {
        padding: 10px;
        flex: 1;
        text-align: center;
    }

    .cms-body {
        display: flex;
        flex-direction: column;
    }

    .cms-row {
        display: flex;
        border-bottom: 1px solid #ccc;
    }

    .cms-row>.cms-cell {
        flex: 1;
        padding: 10px;
        text-align: center;
    }

    .cms-row>.cms-cell input {
        width: 100%;
        box-sizing: border-box;
    }


    #menu {
        position: absolute;
        bottom: 0;
        right: 0;
        /* Adjust as needed */
        z-index: 10;
        /* Ensures the menu is above the carousel images */
    }

    .agetipa_color {
        background-color: #085930;
        font-weight: bold;
    }

    .agetipa_color2 {
    background-color: #6a0dad; /* Couleur violette */
    font-weight: bold;
    }


    .chatgpts-img {
        width: 5rem;

    }

    .chatbot-container {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 350px;
        /* ou la largeur souhaitée */
        display: none;
        /* pour commencer caché */
        z-index: 1050;
    }

    #chatbotButton {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1051;
    }

    .chatbot-position {
        position: fixed;
        z-index: 2;
        top: 0;
        left: 0;
        z-index: 1050;
    }

    .h5-souligne {
        text-decoration: underline;
    }

    .transition-gauche-droit {
        transition: transform 0.2s ease-in-out;
    }

    .transition-gauche-droit:hover {
        transform: scale(1.02);
    }

    span {
        color: white;
    }

    .headbar {
        background: radial-gradient(#FFF, #085930);
    }

    .list-group-item.active {
        background: #085930;
        /* Couleur de fond bleue, par exemple */
        color: white;
        /* Couleur du texte blanc */
        border-color: #FFF;
        /* Couleur de la bordure, pour un look uniforme */
    }

    .pagination .page-item.active .page-link {
        background: #085930;
        /* Couleur de fond bleue, par exemple */
        color: white;
        border-color: #FFF;
    }

    .agetipa-text {
        color: #085930;
    }

    .custom-item {
        padding: 0.5rem 1rem;
        /* Espace intérieur */
        margin-bottom: 0.5rem;
        /* Espace entre les éléments */
        background-color: #f8f9fa;
        /* Couleur de fond légère */
        border: 1px solid #e9ecef;
        /* Bordure légère */
        border-radius: 0.25rem;
        /* Arrondi des coins */
    }

    .custom-item span.fw-bold {
        font-weight: 700;
        color: Black;
        /* Rend le texte en gras */
    }
    @media (max-width: 1200px) {
    .float-on-xl {
        float: left; /* ou 'float: left;' selon vos besoins */
    }
}
#asideMenu li:hover {
    background-color: #f8f9fa; /* Léger fond gris pour les éléments survolés */
}
#asideMenu li.active {
    font-weight: bold;
    background-color: #e9ecef; /* Fond plus foncé pour l'élément actif */
}


#asideMenu {
    display: block;
  }
@media (max-width: 1000px) {
  #asideMenu {
    display: none;
  }
}



    </style>
</head>

<body>

    <header class="">
        <div id="contenair">
            <a href="/">
                <img id="logo" src="<?= base_url("assets/images/logo.png")?>" alt="logo">
            </a>
        </div>
        <h3 style="color: #085930; font-weight: bold;">Agence d'execution des travaux d'intérêt public et d'aménagement
        </h3>
        <a href="/" class="text-success mx-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor"
                class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z" />
            </svg>
        </a>
    </header>


    <!-- boutons  -->
    <div class="bg-light">
        <div class="container">
            <div class="d-flex  justify-content">
                <div class="col mx-1 btn agetipa_color "> <a href="/prompts" class="text-light rounded"
                        aria-current="page">Prompts</a>
                </div>
                <div class="col mx-1 btn agetipa_color "> <a href="/framework" class="text-light rounded">Framework</a>
                </div>
                <div class="col mx-1 btn agetipa_color "><a href="/gpts" class="text-light rounded">GPTs</a>
                </div>
                <div class="col mx-1 btn agetipa_color "><a href="/outilia" class="text-light rounded">Outils</a>
                </div>

            </div>
        </div>
    </div>
    <!-- fin boutons -->