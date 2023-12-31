<?php
require_once 'lib/config.php';
require_once 'lib/session.php';
require_once 'lib/pdo.php';
require_once 'lib/user.php';

require_once 'templates/header.php';


$errors = [];
$messages = [];

if (isset($_SESSION['role'])) {
    if ($_SESSION["role"] == "admin") {
        header("Location: admin/articles.php");
        exit();
    }
}
if (isset($_SESSION['email']) && isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

// Si le formulaire a été souis
if (isset($_POST['loginUser'])) {
    //@todo appeler une méthode verifyUserLoginPassword qui retourne false ou retourne un tableau avec l'utisateur
    $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']);

    if ($user === false) {
        $messages[] = "Utilisateur ou mot de passe incorrect";
    } else {
        $_SESSION["email"] = $user["email"];
        $_SESSION["first_name"] = $user["first_name"];
        $_SESSION["role"] = $user["role"];
        if ($user["role"] == "admin") {
            header("Location: admin/articles.php");
            exit();
        }
        header("Location: index.php");
        exit();
    }

    /* @todo si on récupère un utilisateur, alors on stocke l'utilisateur dans la session
     * et on redirige l'utilisateur soit vers l'admin (si role admin) soit vers l'accueil
     * sinon on affiche une erreur "Email ou mot de passe incorrect"
     */

}

?>
<h1>Login</h1>

<?php
foreach ($messages as $message) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">" . $message . "</div>";
}
?>

<form method="POST">
    <div class="mb-3">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de psse</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <input type="submit" name="loginUser" class="btn btn-primary" value="Enregistrer">

</form>

<?php require_once 'templates/footer.php'; ?>
