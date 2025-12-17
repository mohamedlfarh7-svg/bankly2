<?php 
session_start();
require_once "../config.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

if(isset($_POST['submit'])){
    $client = $_POST['client'];
    $type = $_POST['type'];
    $solde = $_POST['solde'];

    $query = "SELECT * FROM comptes WHERE client_id = '$client'";
    $result = mysqli_query($conn ,$query);

    if(mysqli_num_rows($result)>0){
        echo 'cette client est deja exciste';
    }

    $insert = "INSERT INTO comptes (client_id,type_compte,solde)
                VALUES ('$client','$type','$solde')";
    if(mysqli_query($conn,$insert)){
        header('Location: ../clients/list_clients.php');
        exit();
    }else {
        echo "erreur de ajout :" . mysqli_error($conn);
    }
}

$clientquery = "SELECT*FROM clients";
$clientResult = mysqli_query($conn , $clientquery);

?>
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

    <form id="account-form" method="POST">
        <select class="input-field" name="client" required>
            <option value="">Sélectionner un client</option>
            <?php while( $client = mysqli_fetch_assoc($clientResult)){ ?>
                <option value="<?php echo $client['client_id']; ?>">
                    <?php echo $client['client_id']; ?>
                </option>
            <?php } ?>
        </select>

        <select class="input-field" name="type" required>
            <option value="">Type de compte</option>
            <option value="courant">Courant</option>
            <option value="épargne">Épargne</option>
        </select>

        <input class="input-field" type="number" placeholder="Solde initial" name="solde" required>

        <button id="submit-btn" type="submit" name="submit">Créer le compte</button>
    </form>
</main>

</body>
</html>
