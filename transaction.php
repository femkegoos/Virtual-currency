<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
include_once(__DIR__ . '/classes/Db.php');
include_once(__DIR__ . '/classes/User.php');
include_once(__DIR__ . '/classes/Transaction.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $transaction = Transaction::getById($_GET['id'], $_SESSION['id']);
}

$dagen = [
    'Monday' => 'maandag',
    'Tuesday' => 'dinsdag',
    'Wednesday' => 'woensdag',
    'Thursday' => 'donderdag',
    'Friday' => 'vrijdag',
    'Saturday' => 'zaterdag',
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

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $transaction = Transaction::getById($_GET['id'], $_SESSION['id']);
    if ($transaction) {
        $datum = date('l d F Y H:i', strtotime($transaction['date_created']));
        $datum = str_replace(array_keys($dagen), array_values($dagen), $datum);
        $datum = str_replace(array_keys($maanden), array_values($maanden), $datum);
    }
}




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
                <h2>Transactie <?php echo date('d/m/Y', strtotime($transaction['date_created'])); ?></h2>
                <div class="transaction">
                    <p><b>Van: </b><?php echo htmlspecialchars($transaction['sender_username']); ?></p>
                    <p><b>Naar: </b><?php echo htmlspecialchars($transaction['receiver_username']); ?></p>
                    <p><b>Bedrag: </b><?php echo htmlspecialchars($transaction['amount']); ?> XD</p>
                    <p><b>Reden: </b><?php echo htmlspecialchars($transaction['reason']); ?></p>
                    <p><b>Datum: </b><?php echo $datum; ?></p><br><br>
                </div>
                <a href="index.php" class="btn"> Terug naar alle transacties</a>
            </div>
        </div>
    </div>

</body>

</html>