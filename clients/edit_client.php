<?php 
session_start();
require_once "../config.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id=$_GET['id'];

$sqli = "SELECT*FROM clients WHERE client_id ='$id'";
$res = mysqli_query($conn , $sqli);
$client = mysqli_fetch_assoc($res);

if(isset($_POST['submit'])){
    $f_name = $_POST['fullname'];
    $email = $_POST['email'];
    $cin = $_POST['cin'];
    $phone = $_POST['phone'];

    $update = " UPDATE clients 
                SET nom_complet = '$f_name' , email = '$email' , cin = '$cin' , telephone = '$phone' WHERE client_id ='$id'";
    
    mysqli_query($conn, $update);

    header("Location: list_clients.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    min-height: 100vh;
}

#clien-form {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    gap: 15px;
    max-width: 450px;
}
#clien-form input {
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 7px;
    font-size: 15px;
}
#clien-form input :focus{
    outline: none;
    border-color: #1abc9c;
    box-shadow: 0 0 4px rgba(26,188,156,0.5);
}
#clien-form button {
    padding: 12px;
    border: none;
    background: #1abc9c;
    color: #fff;
    font-size: 16px;
    border-radius: 7px;
    cursor: pointer;
    transition: 0.2s;
}
#clien-form button:hover {
    background: #16a085;
    transform: translateY(-2px);
}

</style>
<body>
    <header id="top-header">Bankly V2 - Ajouter un client</header>
<aside id="sidebar">
    <a class="nav-link" href="../dashboard/dashboard.php">Tableau de bord</a>
    <a class="nav-link" href="../clients/list_clients.php">Clients</a>
    <a class="nav-link" href="../accounts/list_accounts.php">Comptes</a>
    <a class="nav-link" href="../transactions/list_transactions.php">Transactions</a>
    <a class="nav-link" href="../auth/login.php">Déconnexion</a>
</aside>

<div id="main-content">
    <h2>Ajouter un nouveau client</h2>
    <form id="clien-form" method="post">
        <input type="text" name="fullname" id="fullname" class="input-field" placeholder="Nom complet" value="<?php echo $client['nom_complet']; ?>" required>
        <input type="email" name="email" id="email" class="input-field" placeholder="Email" value="<?php echo $client['email']; ?>" required>
        <input type="text" name="cin" id="cin" class="input-field" placeholder="CIN" value="<?php echo $client['cin']; ?>" required>
        <input type="text" name="phone" id="phone" class="input-field" placeholder="Téléphone" value="<?php echo $client['telephone']; ?>">
        <button type="submit" id="submit-btn" class="btn-submit" name="submit">Enregistrer Modifecation</button>
    </form>
</div>
</body>
</html>