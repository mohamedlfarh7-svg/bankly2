<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter un client - Bankly V2</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>Bankly V2 - Ajouter un client</header>
    <div class="sidebar">
    <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
    <a class="nav-link" href="../clients/list_clients.php">Clients</a>
    <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
    <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <a class="nav-link" href="../auth/login.php">Déconnexion</a>
    </div>
    <div class="main">
        <h2>Ajouter un nouveau client</h2>
        <form>
            <input type="text" placeholder="Nom complet" required>
            <input type="email" placeholder="Email" required>
            <input type="text" placeholder="CIN" required>
            <input type="text" placeholder="Téléphone">
            <button type="submit">Enregistrer le client</button>
        </form>
    </div>
</body>
</html>
