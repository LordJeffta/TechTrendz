<?php

function addUser(PDO $pdo, string $first_name, string $last_name, string $email, string $password, $role = "user"): bool
{
    $query = $pdo->prepare("INSERT INTO techtrendz.users (email, password, first_name, last_name, role)
                        VALUES (:email, :password, :first_name, :last_name, :role);");
    $query->bindValue(":first_name", $first_name, PDO::PARAM_STR_CHAR);
    $query->bindValue(":last_name", $last_name, PDO::PARAM_STR_CHAR);
    $query->bindValue(":email", $email, PDO::PARAM_STR_CHAR);
    $query->bindValue(":password", password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR_CHAR);
    $query->bindValue(":role", $role, PDO::PARAM_STR_CHAR);
    return $query->execute();
}

function verifyUserLoginPassword(PDO $pdo, string $email, string $password)
{
    $request = $pdo->prepare("SELECT * FROM users WHERE email = :email;");
    $request->bindValue(":email", $email, PDO::PARAM_STR_CHAR);
    $request->execute();
    $user = $request->fetch();
    if ($user === false) {
        return false;
    }
    if ($email == $user["email"] && password_verify($password, $user["password"])) {
        return $user;
    }
    return false;
}
