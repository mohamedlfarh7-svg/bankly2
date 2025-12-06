<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Effectuer une transaction - Bankly V2</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>Bankly V2 - Transactions</header>
        <div class="sidebar">
    <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
    <a class="nav-link" href="../clients/list_clients.php">Clients</a>
    <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
    <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <a class="nav-link" href="../auth/login.php">Déconnexion</a>
        </div>
        <div class="main">
            <h2>Effectuer un dépôt ou retrait</h2>
            <form id="form">
                <select required>
                <option value="">Sélectionner un compte</option>
                <option value="1">Ali - Courant</option>
                <option value="2">mohamed - Épargne</option>
            </select>
            <select required>
                <option value="">Type de transaction</option>
                <option value="deposit">Dépôt</option>
                <option value="withdrawal">Retrait</option>
            </select>
            <input type="number" placeholder="Montant" required>
            <button type="submit">Valider</button>
            </form>
        </div>
</body>
</html>
