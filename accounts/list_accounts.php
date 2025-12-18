
<?php
session_start();

require_once "../config.php";

if(!isset($_SESSION['username'])){
    header("Location: ../auth/login.php");
    exit();
}

if($_SESSION['role'] !== 'admin'){
    header("Location: ../dashboard/dashboard.php");
    exit();
}
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$accountQuery = "SELECT a.compte_id, a.client_id, a.type_compte, a.solde, a.statut, a.date_creation FROM comptes a ORDER BY a.compte_id ASC";
$accountResult = mysqli_query($conn , $accountQuery);

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
    <?php if($role === 'admin'){ ?>
        <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
        <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <?php } ?>

    <a class="nav-link" href="../auth/logout.php">Déconnexion</a>
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
            <th class="column-title">Date</th>
            <th class="column-title">Actions</th>

        </tr>
    <?php while($row = mysqli_fetch_assoc($accountResult)){?>

            <tr class="table-row">
            <td><?php echo $row['compte_id']; ?></td>
            <td><?php echo $row['client_id']; ?></td>
            <td><?php echo $row['type_compte']; ?></td>
            <td><?php echo $row['solde']; ?></td>
            <td><?php echo $row['statut']; ?></td>
            <td><?php echo $row['date_creation']; ?></td>
            <td class="actions">
                <a class="edit" href="edit_account.php?id=<?php echo $row['compte_id']; ?>">
                    Modifier
                </a>|
                <a class="delete">Supprimer</a>
            </td>
        </tr>
    <?php }?>


    </table>
</main>




<script>
    document.getElementById("add-btn").addEventListener("click", function() {
        window.location.href = "../accounts/add_account.php";
    });
</script>
</body>
</html>
