<?php

function getArticleById(PDO $pdo, int $id): array|bool
{
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function getArticles(PDO $pdo, int $limit = null, int $page = null): array|bool
{
    if ($limit === null && $page === null) {
        $query = $pdo->prepare("SELECT * FROM articles order by id DESC;");
    }else{
        $query = $pdo->prepare("SELECT * FROM articles order by id DESC LIMIT :limit;");
        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
    }
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalArticles(PDO $pdo): int|bool
{
    /*
        @todo récupérer le nombre total d'article (avec COUNT)
    */

    //$result = $query->fetch(PDO::FETCH_ASSOC);
    //return $result['total'];
}

function saveArticle(PDO $pdo, string $title, string $content, string|null $image, int $category_id, int $id = null): bool
{
    if ($id === null) {
        /*
            @todo si id est null, alors on fait une requête d'insection
        */
        //$query = ...
    } else {
        /*
            @todo sinon, on fait un update
        */

        //$query = ...

        //$query->bindValue(':id', $id, $pdo::PARAM_INT);
    }

    // @todo on bind toutes les valeurs communes


    //return $query->execute();  
}

function deleteArticle(PDO $pdo, int $id): bool
{

    /*
        @todo Faire la requête de suppression
    */

    /*
    $query->execute();
    if ($query->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
    */
}
