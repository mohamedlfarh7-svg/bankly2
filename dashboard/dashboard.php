<?php
require_once "../config.php";
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];

if ($role === 'admin') {
    $clientQuery = "SELECT COUNT(*) AS total_clients FROM clients";
    $accountQuery = "SELECT COUNT(*) AS total_accounts FROM comptes";
    $transationQuery = "SELECT SUM(montant) AS total_transation FROM transactions WHERE DATE(date_transaction) = CURDATE()";
} else {
    $clientQuery = "SELECT COUNT(*) AS total_clients FROM clients WHERE agent_id = ".intval($user_id);
    $accountQuery = "SELECT COUNT(*) AS total_accounts FROM comptes WHERE agent_id = ".intval($user_id);
    $transationQuery = "SELECT SUM(montant) AS total_transation FROM transactions WHERE agent_id = ".intval($user_id)." AND DATE(date_transaction) = CURDATE()";
}

$clientResult = mysqli_query($conn, $clientQuery) or die("خطأ في استعلام العملاء: " . mysqli_error($conn));
$clientData = mysqli_fetch_assoc($clientResult);
$totalClients = $clientData['total_clients'];

$accountResult = mysqli_query($conn, $accountQuery) or die("خطأ في استعلام الحسابات: " . mysqli_error($conn));
$accountData = mysqli_fetch_assoc($accountResult);
$totalAccounts = $accountData['total_accounts'];

$transationResult = mysqli_query($conn, $transationQuery) or die("خطأ في استعلام المعاملات: " . mysqli_error($conn));
$transationData = mysqli_fetch_assoc($transationResult);
$totalTransation = $transationData['total_transation'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tableau de bord - Bankly V2</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header id="top-header">
Bankly V2 - Tableau de bord | Bienvenue <?php echo $username; ?> (<?php echo $role; ?>)
</header>

<aside id="sidebar">
    <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
    <a class="nav-link" href="../clients/list_clients.php">Clients</a>
    <?php if($role === 'admin'){ ?>
        <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
        <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <?php } ?>

    <a class="nav-link" href="../auth/logout.php">Déconnexion</a>
</aside>

<div id="main-content">
    <div class="header-actions">
        <h2 class="title">Statistiques rapides</h2>
        <button id="btn-primary">Actualiser</button>
    </div>
    <table class="data-table">
        <tr>
            <th>Nombre de clients</th>
            <th>Nombre de comptes</th>
            <th>Total transactions du jour</th>
        </tr>
        <tr class="table-row">
            <td><?php echo $totalClients; ?></td>
            <td><?php echo $totalAccounts; ?></td>
            <td><?php echo $totalTransation; ?></td>
        </tr>
    </table>
</div>

</body>
</html>
