<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des clients - Bankly V2</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header id="top-header">Bankly V2 - Clients</header>

<aside id="sidebar">
    <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
    <a class="nav-link" href="../clients/list_clients.php">Clients</a>
    <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
    <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <a class="nav-link" href="../auth/login.php">Déconnexion</a>
</aside>

<main id="main-content">
    <div class="header-actions">
        <h2 class="title">Liste des clients</h2>
        <button id="add-btn">Ajouter un client</button>
    </div>

    <table id="clients-table">
        <tr>
            <th class="column-title">ID</th>
            <th class="column-title">Nom</th>
            <th class="column-title">Email</th>
            <th class="column-title">CIN</th>
            <th class="column-title">Actions</th>
        </tr>

        <tr class="table-row">
            <td>1</td>
            <td>Ali</td>
            <td>ali@mail.com</td>
            <td>A123</td>
            <td class="actions">
                <a class="edit">Modifier</a> |
                <a class="delete">Supprimer</a>
            </td>
        </tr>

        <tr class="table-row">
            <td>2</td>
            <td>mohamed</td>
            <td>elfarh@mail.com</td>
            <td>B456</td>
            <td class="actions">
                <a class="edit">Modifier</a> |
                <a class="delete">Supprimer</a>
            </td>
        </tr>
    </table>
</main>

</body>
</html>
