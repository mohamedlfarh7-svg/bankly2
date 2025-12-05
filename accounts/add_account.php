<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter un compte - Bankly V2</title>
<link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header id="top-header">Bankly V2 - Ajouter un compte</header>

<aside id="sidebar">
    <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
    <a class="nav-link" href="../clients/list_clients.php">Clients</a>
    <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
    <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <a class="nav-link" href="../auth/login.php">Déconnexion</a>
</aside>

<main id="main-content">
    <h2 class="title">Ajouter un nouveau compte</h2>

    <form id="account-form">
        <select class="input-field" required>
            <option value="">Sélectionner un client</option>
            <option value="1">Ali</option>
            <option value="2">mohamed</option>
        </select>

        <select class="input-field" required>
            <option value="">Type de compte</option>
            <option value="courant">Courant</option>
            <option value="épargne">Épargne</option>
        </select>

        <input class="input-field" type="number" placeholder="Solde initial" required>

        <button id="submit-btn" type="submit">Créer le compte</button>
    </form>
</main>

</body>
</html>
