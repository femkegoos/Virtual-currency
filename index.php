<?php
session_start();
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Transaction.php');
$transactions = Transaction::getUserTransactions($_SESSION['id']);
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
    <div class="content">
    <h2>Welkom <?php echo htmlspecialchars($_SESSION['username']); ?><br>bij XD Currency!</h2>
    <h1>Jouw transacties</h1>
    <div class="transaction-list">
      <?php foreach ($transactions as $transaction):?>
        <?php if ($transaction['sender_id'] == $_SESSION['id']):?>
       <a href="transfer.php?id=<?php echo $transaction['id']; ?>" class="transaction link">
        <p><?php echo htmlspecialchars($_SESSION['username']);?> heeft <?php echo htmlspecialchars($transaction['amount']); ?> XD gestuurd naar <?php echo htmlspecialchars($transaction['receiver_username']);?> omdat <?php echo htmlspecialchars($transaction['reason']);?></p>
       <p class="transaction-datum"><?php echo date('l d F Y', strtotime($transaction['date_created'])); ?></p>
       </a>
       <?php else: ?>
       <a href="transfer.php?id=<?php echo $transaction['id']; ?>" class="transaction link">
        <p><?php echo htmlspecialchars($transaction['sender_username']);?> heeft <?php echo htmlspecialchars($transaction['amount']); ?> XD gestuurd naar <?php echo htmlspecialchars($_SESSION['username']);?> omdat <?php echo htmlspecialchars($transaction['reason']);?></p>
       <p class="transaction-datum"><?php echo date('l d F Y', strtotime($transaction['date_created'])); ?></p>
       </a>
       <?php endif; ?>
       <?php endforeach;?>
    </div>
    </div>
  </div>
  </div>
  
    

</body>


</html>