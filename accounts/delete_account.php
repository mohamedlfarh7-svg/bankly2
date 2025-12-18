<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id = $_GET['id'];

$sql  = "DELETE FROM transactions WHERE compte_id = $id";
$sqli = "DELETE FROM comptes WHERE compte_id = $id";

if(mysqli_query($conn,$sql) && mysqli_query($conn,$sqli)){
    header("Location: list_accounts.php");
    exit();
}else{
    header('location : delete_account.php');
    exit();
}
