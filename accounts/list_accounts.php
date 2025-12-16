<?php 

session_start();
if(!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin'){
    header("Location: ../dashboard/dashboard.php");
    exit();
    
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des comptes - Bankly V2</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header id="top-header">Bankly V2 - Comptes</header>

<aside id="sidebar">
    <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
    <a class="nav-link" href="../clients/list_clients.php">Clients</a>
    <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
    <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <a class="nav-link" href="../auth/login.php">Déconnexion</a>
</aside>

<main id="main-content">
    <div class="header-actions">
        <h2 class="title">Liste des comptes</h2>
        <button id="add-btn">Ajouter un compte</button>
    </div>

    <table id="accounts-table">
        <tr>
            <th class="column-title">ID</th>
            <th class="column-title">Client</th>
            <th class="column-title">Type</th>
            <th class="column-title">Solde</th>
            <th class="column-title">Statut</th>
            <th class="column-title">Actions</th>
        </tr>

        <tr class="table-row">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="actions">
                <a class="edit">Modifier</a> |
                <a class="delete">Supprimer</a>
            </td>
        </tr>

        <tr class="table-row">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td class="actions">
                <a class="edit">Modifier</a> |
                <a class="delete">Supprimer</a>
            </td>
        </tr>
    </table>
</main>




<script>
    document.getElementById("add-btn").addEventListener("click", function() {
        window.location.href = "../accounts/add_account.php";
    });
</script>
</body>
</html>
