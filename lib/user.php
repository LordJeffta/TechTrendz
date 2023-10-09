<?php

function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password, $role = "user"): bool
{
    $query = $pdo->prepare("INSERT INTO techtrendz.users (email, password, first_name, last_name, role)
                        VALUES (:email, :password, :first_name, :last_name, :role);");
    $query->bindValue(":first_name", $first_name, PDO::PARAM_STR_CHAR);
    $query->bindValue(":last_name", $last_name, PDO::PARAM_STR_CHAR);
    $query->bindValue(":email", $email, PDO::PARAM_STR_CHAR);
    $query->bindValue(":password", $password, PDO::PARAM_STR_CHAR);
    $query->bindValue(":role", $role, PDO::PARAM_STR_CHAR);
    error_log($query->queryString);
    return $query->execute();
}

function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
    /*
        @todo faire une requête qui récupère l'utilisateur par email et stocker le résultat dans user
        Attention faire une requête préparer et à binder les paramètres
    */


    /*
        @todo Si on a un utilisateur et que le mot de passe correspond (voir fonction  native password_verify)
              alors on retourne $user
              sinon on retourne false
    */


}
