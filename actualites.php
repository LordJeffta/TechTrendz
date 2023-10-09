<?php
require_once __DIR__ . "/lib/config.php";
require_once __DIR__ . "/lib/pdo.php";
require_once __DIR__ . "/lib/article.php";
require_once __DIR__ . "/templates/header.php";

// @todo On doit appeler getArticale pour récupérer les articles et faire une boucle pour les afficher
$articles = getArticles($pdo);

?>

<h1>TechTrendz Actualités</h1>

<div class="row text-center">
    <?php
    foreach ($articles as $article) {
        if ($article["image"] === null) {
            $article["image"] = "/assets/images/default-article.jpg";
        } else {
            $article["image"] = "/uploads/articles/" . $article["image"];
        }
        echo "<div class=\"col-md-4 my-2 d-flex\">
        <div class=\"card\">
            <img src=\"" . $article["image"] . "\" class=\"card-img-top\" alt=\"" . $article["title"] . "\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">" . $article["title"] . "</h5>
                <a href=\"actualite.php?id=" . $article["id"] . "\" class=\"btn btn-primary\">Lire la suite</a>
            </div>
        </div>
    </div>";
    }

    ?>
</div>

<?php require_once __DIR__ . "/templates/footer.php"; ?>
