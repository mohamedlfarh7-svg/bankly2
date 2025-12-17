<?php 
session_start();
require_once "../config.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

if(isset($_POST['submit'])){
    $f_name = $_POST['fullname'];
    $email = $_POST['email'];
    $cin = $_POST['cin'];
    $phone = $_POST['phone'];

    $query = "SELECT*FROM clients WHERE nom_complet = '$f_name' or email = '$email' or cin = '$cin' or telephone = '$phone'";
    $result = mysqli_query($conn , $query);

    if(mysqli_num_rows($result)>0){
        die('cette client deja exciste');
    }
   $insert = "INSERT INTO clients (nom_complet, email, cin, telephone) 
             VALUES ('$f_name', '$email', '$cin', '$phone')";

    if(mysqli_query($conn,$insert)){
        header('Location: ../clients/list_clients.php');
        exit();
    }else {
        echo "erreur de ajout :" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ajouter un client - Bankly V2</title>
<link rel="stylesheet" href="../css/style.css">
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
</head>
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
        <input type="text" name="fullname" id="fullname" class="input-field" placeholder="Nom complet" required>
        <input type="email" name="email" id="email" class="input-field" placeholder="Email" required>
        <input type="text" name="cin" id="cin" class="input-field" placeholder="CIN" required>
        <input type="text" name="phone" id="phone" class="input-field" placeholder="Téléphone">
        <button type="submit" id="submit-btn" class="btn-submit" name="submit">Enregistrer le client</button>
    </form>
</div>
</body>
</html>
