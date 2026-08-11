<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Transaction.php');
$transactions = Transaction::getUserTransactions($_SESSION['id']);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://use.typekit.net/tkk7yuy.css">
    <title>Transactie</title>
</head> 
<body>
     <?php include_once(__DIR__ . '/nav.php'); ?>
  <div class="container-account">
  <div class="container">
    <div class="content">
    <h2>Transactie 20/08/2026</h2>
    <div class="transaction">
      <p><b>Van:</b>Femke</p>
      <p><b>Naar</b>Silke</p>
      <p><b>Bedrag:</b>10 XD</p>
      <p><b>Reden:</b>Shopping terugbetaling</p>
      <p><b>Datum:</b>Maandag 20 augustus 2026</p>
    </div>
    <a href="index.php" class="btn"> Terug naar alle transacties</a>
    </div>
  </div>
  </div>
  
</body>
</html>