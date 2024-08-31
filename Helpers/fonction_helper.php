<?php

if (!function_exists('create_modal_template')) {
    function create_modal_template($modal_id = "", $modal_body = "") : string {
        $unique_id = $modal_id . rand(1, 100) + rand(1, 100);
        $modal_body_id = 'modal-body-' . $unique_id;
        $modal_template = <<<HTML
        <a class="link-primary" data-bs-toggle="modal" data-bs-target="#{$unique_id}">
            suite...
        </a>
        <div class="modal fade" id="{$unique_id}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{$unique_id}Label"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-dialog modal-dialog-scrollable" id="{$modal_body_id}">
                            {$modal_body}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary" onclick="copyToClipboard('{$modal_body_id}')">Copie</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
function copyToClipboard(id) {
  try {
    // Récupère le texte de l'élément par son ID
    let text = document.getElementById(id).innerText;

    // Copie le texte dans le presse-papiers
    navigator.clipboard.writeText(text)
      .then(() => {
        // Affiche une alerte pour indiquer que le texte a été copié
        alert("Texte copié avec succès!");
      })
      .catch((err) => {
        // En cas d'erreur, affiche une alerte indiquant l'échec
        alert("Échec de la copie du texte : " + err);
      });
  } catch (err) {
    // En cas d'erreur, affiche une alerte indiquant l'échec
    alert("Échec de la copie du texte : " + err);
  }
}
        </script>
HTML;
        return $modal_template;
    }
}


if (!function_exists('displayFrameworkSnippet')) {
    function displayFrameworkSnippet($row, $id="", $framework="") {
            // Vérifiez d'abord si les clés fournies existent dans le tableau
        if (!isset($row[$id]) || !isset($row[$framework])) {
            return 'Les clés spécifiées ne sont pas valides.'; // Ou tout autre message d'erreur ou gestion d'erreur appropriée
         }

        // Extraire les valeurs en utilisant les clés
         $id = $row[$id];
         $framework = $row[$framework];
        
         // Vérifier si la chaîne 'framework' est plus longue que 150 caractères
        if (strlen($framework) > 150) {
            // Tronquer la chaîne à 150 caractères et échapper les caractères spéciaux HTML
            $content = substr(htmlspecialchars($framework), 0, 150);
            // Ajouter le template de modal basé sur l'id et le contenu complet de 'framework'
            $content .= create_modal_template($id, htmlspecialchars($framework));
        } else {
            // Échapper les caractères spéciaux HTML si la chaîne est de 150 caractères ou moins
            $content = htmlspecialchars($framework);
        }
        // Retourner le contenu généré
        return $content;
    }
}

if(!function_exists("tableauDesElements")){
  function tableaudesElements($results=[]):string
  {
    $html = '<div class="p-5">
            <table class="table table-info table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Activités</th>
                        <th>Tâches</th>
                        <th>Outils</th>
                        <th>Framework</th>
                        <th>Prompt</th>
                        <th>Actions</th>
                        <th>Résultats</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($results as $row) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($row['id']) . '</td>
                        <td>' . htmlspecialchars($row['activites']) . '</td>
                        <td>' . htmlspecialchars($row['taches']) . '</td>
                        <td>' . htmlspecialchars($row['outils']) . '</td>
                        <td>' . displayFrameworkSnippet($row, 'id', 'framework') . '</td>
                        <td>' . displayFrameworkSnippet($row, 'id', 'prompt') . '</td>
                        <td>' . htmlspecialchars($row['actions']) . '</td>
                        <td>' . displayFrameworkSnippet($row, 'id', 'resultats') . '</td>
                      </tr>';
        }

        $html .= '</tbody>
            </table>
        </div>';

        return $html;
    }
}
if(!function_exists("displayFrameworks")){
function displayFrameworks($activities) {
    if(!empty($activities)) {
        $html = '<div class="container">';
        foreach($activities as $activity) {
            $html .= '<div class="row my-5 alert alert-light shadow transition-gauche-droit">';
            $html .= '<div class="d-flex justify-content-between w-100"';
            $html .= '<h4 class="w-100">Activité : ' . htmlspecialchars($activity['activites']) .'</h4><a class="btn shadow" href='.site_url("/promptia/edit/".$activity["id"]).'>Edit</a>';
            $html .= '</div>';
            $html .= '<div class="w-100">Tâches : ' . $activity['taches'] . '</div>';
            $html .= '<div class="w-100">Outils : ' . htmlspecialchars($activity['outils']) . '</div>';
            $html .= '<div class="w-100">Framework : ' . $activity['framework'] . '</div>';
            $html .= '<div class="w-100 alert alert-info my-3"><span class="badge badge-warning">Prompt : </span>' . htmlspecialchars($activity['prompt']) . '</div>';
            $html .= '<div class="w-100">Actions : ' . $activity['actions'] . '</div>';
            $html .= '<div class="w-100 alert alert-success my-2"><span class="badge badge-warning"> Résultats : </span>' . htmlspecialchars($activity['resultats']) . '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }
    return '';
}
}


if(!function_exists("displayPagination1")){
  function displayPagination1($pageActuelle, $pages) {
echo '<nav aria-label="Page navigation example">';
echo '<ul class="pagination">';

// Bouton Précédent
if ($pageActuelle > 1) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($pageActuelle - 1) . '">Previous</a></li>';
} else {
    echo '<li class="page-item disabled"><span class="page-link">Previous</span></li>';
}

// Pages
$start = max(1, $pageActuelle - 3);
$end = min($pages, $pageActuelle + 3);

for ($i = $start; $i <= $end; $i++) {
    if ($i == $pageActuelle) {
        echo "<li class=\"page-item active\"><span class=\"page-link\">$i</span></li>";
    } else {
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=$i\">$i</a></li>";
    }
}

// Bouton Suivant
if ($pageActuelle < $pages) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($pageActuelle + 1) . '">Next</a></li>';
} else {
    echo '<li class="page-item disabled"><span class="page-link">Next</span></li>';
}

echo '</ul>';
echo '</nav>';

  }}

  if (!function_exists("displayPagination")) {
    function displayPagination($pages, $page, $get) {
        // Copy current GET parameters and unset the page parameter to avoid duplication
        $queryParams = $get;
        unset($queryParams['page']);

        ?>
<div class="container">
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item <?php echo $page <= 1 ? "disabled" : ""; ?>">
            <?php
                    // Update the page parameter for the Previous link
                    $queryParams['page'] = $page - 1;
                    $prevPageLink = "?" . http_build_query($queryParams);
                    ?>
            <a class="page-link agetipa-text" href="<?php echo $page > 1 ? $prevPageLink : "#"; ?>">Previous</a>
        </li>
        <li class="page-item active">
            <a class="page-link agetipa-text" href="#"><?php echo $page; ?></a>
        </li>
        <?php if ($pages > 1): ?>
        <?php if ($pages > $page): ?>
        <li class="page-item">
            <?php
                            // Update the page parameter for the Next page link
                            $queryParams['page'] = $page + 1;
                            $nextPageLink = "?" . http_build_query($queryParams);
                            ?>
            <a class="page-link agetipa-text" href="<?php echo $nextPageLink; ?>"><?php echo $page + 1; ?></a>
        </li>
        <?php endif; ?>
        <?php if ($pages > $page + 1): ?>
        <li class="page-item ">
            <?php
                            // Update the page parameter for the page after next link
                            $queryParams['page'] = $page + 2;
                            $pageAfterNextLink = "?" . http_build_query($queryParams);
                            ?>
            <a class="page-link agetipa-text" href="<?php echo $pageAfterNextLink; ?>"><?php echo $page + 2; ?></a>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <li class="page-item <?php echo $page < $pages ? "" : "disabled"; ?>">
            <?php
                    // Update the page parameter for the Next link
                    $queryParams['page'] = $page + 1;
                    $nextLink = "?" . http_build_query($queryParams);
                    ?>
            <a class="page-link agetipa-text" href="<?php echo $page < $pages ? $nextLink : "#"; ?>">Next</a>
        </li>
    </ul>
</nav>
</div>
<?php
    }
}

if (!function_exists("displayPagination2")) {
    function displayPagination2($pages, $page, $get) {
        // Copy current GET parameters and unset the page parameter to avoid duplication
        $queryParams = $get;
        unset($queryParams['page']);

        ?>
<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item <?php echo $page <= 1 ? "disabled" : ""; ?>">
            <?php
                    // Update the page parameter for the Previous link
                    $queryParams['page'] = $page - 1;
                    $prevPageLink = "?" . http_build_query($queryParams);
                    ?>
            <a class="page-link" href="<?php echo $page > 1 ? $prevPageLink : "#"; ?>">Previous</a>
        </li>
        <li class="page-item active">
            <a class="page-link" href="#"><?php echo $page; ?></a>
        </li>
        <?php if ($pages > 1): ?>
        <?php if ($pages > $page): ?>
        <li class="page-item">
            <?php
                            // Update the page parameter for the Next page link
                            $queryParams['page'] = $page + 1;
                            $nextPageLink = "?" . http_build_query($queryParams);
                            ?>
            <a class="page-link" href="<?php echo $nextPageLink; ?>"><?php echo $page + 1; ?></a>
        </li>
        <?php endif; ?>
        <?php
                    // Ensure the third button is correctly displayed only if it makes sense
                    if ($page + 1 < $pages): ?>
        <li class="page-item">
            <?php
                            // Update the page parameter for the page after next link
                            $queryParams['page'] = $page + 2;
                            $pageAfterNextLink = "?" . http_build_query($queryParams);
                            ?>
            <a class="page-link" href="<?php echo $pageAfterNextLink; ?>"><?php echo $page + 2; ?></a>
        </li>
        <?php endif; ?>
        <?php endif; ?>
        <li class="page-item <?php echo $page < $pages ? "" : "disabled"; ?>">
            <?php
                    // Update the page parameter for the Next link
                    $queryParams['page'] = $page + 1;
                    $nextLink = "?" . http_build_query($queryParams);
                    ?>
            <a class="page-link" href="<?php echo $page < $pages ? $nextLink : "#"; ?>">Next</a>
        </li>
    </ul>
</nav>
<?php
    }
}


?>