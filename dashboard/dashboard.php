<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}
$username = $_SESSION['username'];
$role = $_SESSION['role'];
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
            <td>12</td>
            <td>8</td>
            <td>2500.00</td>
        </tr>
    </table>
</div>

</body>
</html>
