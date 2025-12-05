<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tableau de bord - Bankly V2</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
<header id="top-header">Bankly V2 - Tableau de bord</header>

<div class="sidebar">
    <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
    <a class="nav-link" href="../clients/list_clients.php">Clients</a>
    <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
    <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <a class="nav-link" href="../auth/login.php">Déconnexion</a>
</div>

<div class="main-content">
    <h2 class="page-title">Statistiques rapides</h2>

    <button class="btn-primary">Actualiser</button>

    <table class="data-table">
        <tr>
            <th>Nombre de clients</th>
            <th>Nombre de comptes</th>
            <th>Total transactions du jour</th>
        </tr>
        <tr>  
            <td>12</td>
            <td>8</td>
            <td>2500.00</td>
        </tr>
    </table>
</div>

</body>
</html>
