<?php
session_start();
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://use.typekit.net/tkk7yuy.css">
    <title>XD Currency</title>
</head> 


<body>
  <?php include_once(__DIR__ . '/nav.php'); ?>
  <div class="container-account">
  <div class="container">
    <h1>Welkom <?php echo htmlspecialchars($_SESSION['username']); ?> bij XD Currency!</h1>
    <h1>Transacties</h1>
    <div class="transaction-list">
       <a href="transfer.php?id=1" class="transaction"><p>Iemand heeft 10 XD naar jou overgemaakt</p>
       <p class="transaction-datum">Maandag 9 April 2026</p>
       </a>

       <a href="transfer.php?id=1" class="transaction"><p>Iemand heeft 10 XD naar jou overgemaakt</p>
       <p class="transaction-datum">Maandag 9 April 2026</p>
       </a>

       <a href="transfer.php?id=1" class="transaction list"><p>Iemand heeft 10 XD naar jou overgemaakt</p>
       <p class="transaction-datum">Maandag 9 April 2026</p>
       </a>

    </div>
  </div>
  </div>
  
    

</body>


</html>