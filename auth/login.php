<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';

    if($name === "admin" && $password === "admin"){
        header("Location: ../dashboard/dashboard.php");
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bankly V2</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main id="login-page">
    <div id="login-box">
        <h2 class="title">Connexion</h2>
        <form id="login-form" method="post">
            <input type="text" class="input-field" name="name" placeholder="Nom d'utilisateur" required>
            <input type="password" class="input-field" name="password" placeholder="Mot de passe" required>
            <button type="submit" id="submit-btn">Se connecter</button>
        </form>
    </div>
</main>


<?php if(isset($error)): ?>
<p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>



</body>
</html>
