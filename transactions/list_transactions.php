
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

$transactionQuery = "SELECT t.transaction_id, t.compte_id, t.type_transaction, t.montant, t.date_transaction FROM transactions t ORDER BY t.date_transaction DESC";
$transactionResult = mysqli_query($conn, $transactionQuery) 
?>

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
    <?php if($role === 'admin'){ ?>
        <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
        <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <?php } ?>

    <a class="nav-link" href="../auth/logout.php">Déconnexion</a>
</aside>
    <main id="main-content">
            <div class="header-actions">
                <h2 class="title">Historique des transactions</h2>
                <button id="add-btn">Make Transaction</button>
            </div>

        <table id="transactions-table">
            <tr>
                <th class="column-title">ID</th>
                <th class="column-title">Compte</th>
                <th class="column-title">Type</th>
                <th class="column-title">Montant</th>
                <th class="column-title">Date</th>
            </tr>

    <?php while($row = mysqli_fetch_assoc($transactionResult)) { ?>
        <tr class="table-row">
            <td><?php echo $row['transaction_id']; ?></td>
            <td><?php echo $row['compte_id']; ?></td>
            <td><?php echo $row['type_transaction']; ?></td>
            <td><?php echo $row['montant']; ?></td>
            <td><?php echo $row['date_transaction']; ?></td>
        </tr>
    <?php } ?>
        </table>
    </main>
<script>
        document.getElementById("add-btn").addEventListener("click", function() {
        window.location.href = "../transactions/make_transaction.php";
    });
</script>
</body>
</html>
