<?php
session_start();
include_once(__DIR__ . '/../classes/Db.php');
include_once(__DIR__ . '/../classes/User.php');
include_once(__DIR__ . '/../classes/Transaction.php');
include_once(__DIR__ . '/../classes/Date.php');

if (!isset($_SESSION['id'])) {
    header("Content-Type: application/json");
    echo json_encode(['status' => 'error', 'message' => 'Niet ingelogd']);
    exit;
}

$transactions = Transaction::getUserTransactions($_SESSION['id']);


$response = [];

foreach ($transactions as $transaction) {
   $datum = Date::format($transaction['date_created']);

    $isSender = ($transaction['sender_id'] == $_SESSION['id']);

    $response[] = [
        'id' => $transaction['id'],
        'amount' => htmlspecialchars($transaction['amount']),
        'datum' => $datum,
        'isSender' => $isSender,
        'otherUsername' => htmlspecialchars($isSender ? $transaction['receiver_username'] : $transaction['sender_username']),
        'ownUsername' => htmlspecialchars($_SESSION['username'])
    ];
}
header("Content-Type: application/json");
echo json_encode(['status' => 'succes', 'transactions' => $response]);
?>
