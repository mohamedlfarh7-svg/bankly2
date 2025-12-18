<?php 
session_start();
require_once "../config.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

if(isset($_POST['submit'])){
    $compte = $_POST['compte'];
    $type = $_POST['type'];
    $montant = $_POST['montant'];

    $sql = "SELECT solde FROM comptes WHERE compte_id = $compte";
    $res = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($res);
    $solde = $data['solde'];

    if($type === 'retrait'){
        if($montant > $solde){
            die("Solde insuffisant");
        }
        $newSolde = $solde - $montant;
    } else {
        $newSolde = $solde + $montant;
    }

    $insertTransaction = "INSERT INTO transactions (compte_id,type_transaction, montant)
                            VALUES ($compte, '$type', $montant)
                        ";
    mysqli_query($conn, $insertTransaction);

    $updateSolde = "
        UPDATE comptes SET solde = $newSolde WHERE compte_id = $compte
    ";
    mysqli_query($conn, $updateSolde);

    header("Location: ../transactions/list_transactions.php");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$query = "SELECT * FROM comptes";
$result = mysqli_query($conn , $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Effectuer une transaction - Bankly V2</title>
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
        <div id="main-content">
            <h2>Effectuer un dépôt ou retrait</h2>
            <form id="form" method="post">
                <select name="compte" required>
                        <option value="">Sélectionner un compte</option>
                    <?php while($compte = mysqli_fetch_assoc($result)) {?>
                        <option value="<?php echo $compte['compte_id'] ?>">
                            <?php echo $compte['compte_id']?>
                        </option>
                    <?php } ?>
                </select>
                <select name="type" required>
                    <option >Type de transaction</option>
                    <option value="depot">depot</option>
                    <option value="retrait">retrait</option>
                </select>
                <input type="number" placeholder="Montant" name="montant" required>
                <button type="submit" name="submit">Valider</button>
            </form>
        </div>
</body>
</html>
