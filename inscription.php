<?php
require_once 'lib/config.php';
require_once 'lib/tools.php';
require_once 'lib/pdo.php';
require_once 'lib/user.php';

require_once 'templates/header.php';

$errors = [];
$messages = [];

if (isset($_POST['addUser'])) {
    $res = addUser($pdo, $_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["password"]);
    if ($res){
        $messages[] = "Merci pour votre inscription";
    }
}

?>
<h1>Inscription</h1>


<?php
foreach ($messages as $message){
    echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
}
?>

<form method="POST">
    <div class="mb-3">
        <label for="first_name" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="first_name" name="first_name">
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="last_name" name="last_name">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de psse</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <input type="submit" name="addUser" class="btn btn-primary" value="Enregistrer">

</form>

<?php require_once 'templates/footer.php'; ?>
