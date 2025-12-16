<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Historique des transactions - Bankly V2</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <header id="top-header">Bankly V2 - Transactions</header>

    <aside id="sidebar">
        <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
        <a class="nav-link" href="../clients/list_clients.php">Clients</a>
        <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
        <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
        <a class="nav-link" href="../auth/login.php">Déconnexion</a>
    </aside>

    <main id="main-content">
        <h2 class="title">Historique des transactions</h2>

        <table id="transactions-table">
            <tr>
                <th class="column-title">ID</th>
                <th class="column-title">Compte</th>
                <th class="column-title">Type</th>
                <th class="column-title">Montant</th>
                <th class="column-title">Date</th>
            </tr>

            <tr class="table-row">
                <td>1</td>
                <td>Courant</td>
                <td></td>
                <td>1200</td>
                <td>27/8/2025</td>
            </tr>

            <tr class="table-row">
                <td>2</td>
                <td>Courant</td>
                <td></td>
                <td>2800</td>
                <td>25/3/2024</td>
            </tr>
        </table>
    </main>

</body>
</html>
