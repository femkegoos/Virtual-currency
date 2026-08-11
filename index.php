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

$dagen = [
    'Monday' => 'maandag',
    'Tuesday' => 'dinsdag',
    'Wednesday' => 'woensdag',
    'Thursday' => 'donderdag',
    'Friday' => 'vrijdag',
    'Saterday' => 'zaterdag',
    'Sunday' => 'zondag'
];

$maanden = [
    'January' => 'januari',
    'February' => 'februari',
    'March' => 'maart',
    'April' => 'april',
    'May' => 'mei',
    'June' => 'juni',
    'July' => 'juli',
    'August' => 'augustus',
    'September' => 'september',
    'October' => 'oktober',
    'November' => 'november',
    'December' => 'december'
];
$datum = date('l d F Y', strtotime($transactions['date_created']));
$datum = str_replace(array_keys($dagen), array_values($dagen), $datum);
$datum = str_replace(array_keys($maanden), array_values($maanden), $datum);

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
       <a href="transaction.php?id=<?php echo $transaction['id']; ?>" class="transaction link">
        <p><?php echo htmlspecialchars($_SESSION['username']);?> heeft <?php echo htmlspecialchars($transaction['amount']); ?> XD gestuurd naar <?php echo htmlspecialchars($transaction['receiver_username']);?> </p>
       <p class="transaction-datum"><?php echo date('l d F Y', strtotime($transaction['date_created'])); ?></p>
       </a>
       <?php else: ?>
       <a href="transaction.php?id=<?php echo $transaction['id']; ?>" class="transaction link">
        <p><?php echo htmlspecialchars($transaction['sender_username']);?> heeft <?php echo htmlspecialchars($transaction['amount']); ?> XD gestuurd naar <?php echo htmlspecialchars($_SESSION['username']);?></p>
       <p class="transaction-datum"><?php echo $datum ?></p>
       </a>
       <?php endif; ?>
       <?php endforeach;?>
    </div>
    </div>
  </div>
  </div>
  
    

</body>


</html>