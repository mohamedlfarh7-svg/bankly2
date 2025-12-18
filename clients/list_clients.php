<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$query = "SELECT * FROM clients";
$result = mysqli_query($conn, $query);
?>


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
    <?php if($role === 'admin'){ ?>
        <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
        <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <?php } ?>

    <a class="nav-link" href="../auth/logout.php">Déconnexion</a>
</aside>

<main id="main-content">
    <div class="header-actions">
        <h2 class="title">Liste des clients</h2>
    <?php if($role === 'admin'){ ?>
        <button id="add-btn">Ajouter un client</button>
    <?php } ?>
    </div>

<table id="clients-table">
    <tr>
        <th>ID</th>
        <th>Nom complet</th>
        <th>Email</th>
        <th>CIN</th>
        <th>Téléphone</th>
        <th>Date de création</th>
        <?php if($role === 'admin'){ ?>
        <th>Actions</th>
        <?php } ?>
    </tr>
    <?php while($client = mysqli_fetch_assoc($result)){ ?>
    <tr class="table-row">
        <td><?php echo $client['client_id']; ?></td>
        <td><?php echo $client['nom_complet']; ?></td>
        <td><?php echo $client['email']; ?></td>
        <td><?php echo $client['cin']; ?></td>
        <td><?php echo $client['telephone']; ?></td>
        <td><?php echo $client['date_creation']; ?></td>

        <?php if($role === 'admin'){ ?>
        <td class="actions">
            <a class="edit" href="edit_client.php?id=<?php echo $client['client_id']; ?>">
                Modifier
            </a>
        </td>
        <?php } ?>
    </tr>
    <?php } ?>

</table>
</main>



<script>
    document.getElementById("add-btn").addEventListener("click", function() {
        window.location.href = "../clients/add_client.php";
    });
</script>
</body>
</html>
