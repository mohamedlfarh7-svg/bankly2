<?php 
session_start();
require_once "../config.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

$sqli = "SELECT * FROM comptes WHERE compte_id='$id'";
$res = mysqli_query($conn, $sqli);
$compte = mysqli_fetch_assoc($res);

if(isset($_POST['submit'])){
    $type = $_POST['type'];
    $statut = $_POST['statut'];

    $update = "
        UPDATE comptes 
        SET type_compte='$type', statut='$statut'
        WHERE compte_id='$id'
    ";
    mysqli_query($conn, $update);

    header("Location: list_accounts.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter un compte - Bankly V2</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header id="top-header">Bankly V2 - Ajouter un compte</header>

<aside id="sidebar">
    <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
    <a class="nav-link" href="../clients/list_clients.php">Clients</a>
    <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
    <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <a class="nav-link" href="../auth/login.php">Déconnexion</a>
</aside>

<main id="main-content">
    <h2 class="title">Ajouter un nouveau compte</h2>

    <form id="account-form" method="POST">

        <select class="input-field" name="type" required>
            <option value="">Type de compte</option>
            <option  value="courant" <?= $compte['type_compte']=='courant'?'selected':'' ?>>Courant</option>
            <option value="épargne"<?= $compte['type_compte']=='Épargne' ? 'selected':'' ?>>Épargne</option>
        </select>

        <select class="input-field" name="statut" required>
            <option value="">Statuts</option>
            <option value="actif" <?=$compte['statut'] == 'actif' ? 'selected' : '' ?>>actif</option>
            <option value="inactif"<?= $compte['statut'] == 'inactif' ? 'selected' : '' ?>>inactif</option>
        </select>

        <button id="submit-btn" type="submit" name="submit">Modifier</button>
    </form>
</main>
</body>
</html>
