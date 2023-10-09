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
    } else if ($page === null || $page == 1) {
        $query = $pdo->prepare("SELECT * FROM articles order by id DESC LIMIT :limit;");
        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
    } else {
        $query = $pdo->prepare("SELECT * FROM articles order by id DESC LIMIT :limit OFFSET :offset;");
        $query->bindValue(":limit", $limit, PDO::PARAM_INT);
        $offset = $limit * ($page - 1);
        $query->bindValue(":offset", $offset, PDO::PARAM_INT);
    }
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalArticles(PDO $pdo): int|bool
{
    $query = $pdo->prepare("SELECT COUNT(*) total FROM articles;");
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result["total"];
}

function saveArticle(PDO $pdo, string $title, string $content, string|null $image, int $category_id, int $id = null): bool
{
    if ($id === null) {
        $query = $pdo->prepare("INSERT INTO techtrendz.articles (category_id, title, content, image)
            VALUES (:category_id, :title, :content, :image);");
    } else {
        $query = $pdo->prepare("UPDATE techtrendz.articles t
        SET t.category_id = :category_id,
            t.title = :title,
            t.content = :content,
            t.image = :image
        WHERE t.id = :id;");
        $query->bindValue(':id', $id, $pdo::PARAM_INT);

    }
    $query->bindValue(":category_id", $category_id, PDO::PARAM_STR_CHAR);
    $query->bindValue(":title", $title, PDO::PARAM_STR_CHAR);
    $query->bindValue(":content", $content, PDO::PARAM_STR_CHAR);
    $query->bindValue(":image", $image, PDO::PARAM_STR_CHAR);
    return $query->execute();
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
